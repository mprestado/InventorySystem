<x-card class="max-w-2xl">
    <form method="POST" action="{{ $action }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @csrf @if(isset($supplier)) @method('PUT') @endif
        <x-field class="sm:col-span-2" label="Supplier Name" name="name" :value="$supplier->name ?? ''" required />
        <x-field label="Contact Person" name="contact_person" :value="$supplier->contact_person ?? ''" />
        <x-field label="Phone" name="phone" :value="$supplier->phone ?? ''" />
        <x-field label="Email" name="email" type="email" :value="$supplier->email ?? ''" />
        <x-field label="Status" name="status" type="select">
            <option value="active" @selected(($supplier->status ?? 'active')=='active')>Active</option>
            <option value="archived" @selected(($supplier->status ?? '')=='archived')>Archived</option>
        </x-field>
        <x-field class="sm:col-span-2" label="Address" name="address" type="textarea" :value="$supplier->address ?? ''" />
        <x-field class="sm:col-span-2" label="Notes" name="notes" type="textarea" :value="$supplier->notes ?? ''" />
        <div class="sm:col-span-2 flex gap-2 pt-2">
            <x-btn type="submit">{{ isset($supplier) ? 'Update' : 'Save' }}</x-btn>
            <x-btn href="{{ route('suppliers.index') }}" variant="secondary">Cancel</x-btn>
        </div>
    </form>
</x-card>
