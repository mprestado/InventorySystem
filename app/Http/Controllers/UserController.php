<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('roles')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%$s%")->orWhere('email', 'like', "%$s%"))
            ->orderBy('name')->paginate(15)->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create', ['roles' => Role::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required', 'exists:roles,name'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
        ]);
        $user->syncRoles([$data['role']]);
        ActivityLogger::log('create', "Created user: {$user->name} ({$data['role']})", $user);

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user, 'roles' => Role::orderBy('name')->get()]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'string', 'max:50'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => ['required', 'exists:roles,name'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'status' => $data['status'],
        ]);
        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();
        $user->syncRoles([$data['role']]);
        ActivityLogger::log('update', "Updated user: {$user->name}", $user);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        $name = $user->name;
        $user->delete();
        ActivityLogger::log('delete', "Deleted user: {$name}", $user);

        return back()->with('success', 'User deleted.');
    }
}
