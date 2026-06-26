<x-card class="max-w-xl">
    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf @if(isset($user)) @method('PUT') @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-field label="Full Name" name="name" :value="$user->name ?? ''" required />
            <x-field label="Email" name="email" type="email" :value="$user->email ?? ''" required />
            <x-field label="Phone" name="phone" :value="$user->phone ?? ''" />
            <x-field label="Role" name="role" type="select" required>
                @foreach ($roles as $r)<option value="{{ $r->name }}" @selected(isset($user) && $user->hasRole($r->name))>{{ $r->name }}</option>@endforeach
            </x-field>
            <x-field label="Password {{ isset($user) ? '(leave blank to keep)' : '' }}" name="password" type="password" :required="!isset($user)" />
            <x-field label="Confirm Password" name="password_confirmation" type="password" :required="!isset($user)" />
            <x-field label="Status" name="status" type="select">
                <option value="active" @selected(($user->status ?? 'active')=='active')>Active</option>
                <option value="inactive" @selected(($user->status ?? '')=='inactive')>Inactive</option>
            </x-field>
        </div>
        <div class="flex gap-2 pt-2">
            <x-btn type="submit">{{ isset($user) ? 'Update User' : 'Create User' }}</x-btn>
            <x-btn href="{{ route('users.index') }}" variant="secondary">Cancel</x-btn>
        </div>
    </form>
</x-card>
