<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::withCount('sales')->withSum('sales', 'total')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%$s%")
                ->orWhere('phone', 'like', "%$s%"))
            ->orderBy('name')->paginate(15)->withQueryString();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $customer = Customer::create($this->validateData($request));
        ActivityLogger::log('create', "Created customer: {$customer->name}", $customer);

        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['sales' => fn ($q) => $q->with('items')->latest()->limit(20)]);

        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($this->validateData($request));
        ActivityLogger::log('update', "Updated customer: {$customer->name}", $customer);

        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        $name = $customer->name;
        $customer->delete();
        ActivityLogger::log('delete', "Deleted customer: {$name}", $customer);

        return back()->with('success', 'Customer deleted.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);
    }
}
