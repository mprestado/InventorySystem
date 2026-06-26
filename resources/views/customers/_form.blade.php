<x-card class="max-w-xl">
    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf @if(isset($customer)) @method('PUT') @endif
        <x-field label="Name" name="name" :value="$customer->name ?? ''" required />
        <div class="grid grid-cols-2 gap-4">
            <x-field label="Phone" name="phone" :value="$customer->phone ?? ''" />
            <x-field label="Email" name="email" type="email" :value="$customer->email ?? ''" />
        </div>
        <x-field label="Address" name="address" type="textarea" :value="$customer->address ?? ''" />
        <div class="flex gap-2 pt-2">
            <x-btn type="submit">{{ isset($customer) ? 'Update' : 'Save' }}</x-btn>
            <x-btn href="{{ route('customers.index') }}" variant="secondary">Cancel</x-btn>
        </div>
    </form>
</x-card>
