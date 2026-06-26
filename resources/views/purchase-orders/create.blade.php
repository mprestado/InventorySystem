@extends('layouts.app')
@section('title', 'New Purchase Order')
@section('content')
<x-page-header title="New Purchase Order" subtitle="Order stock from a supplier" />

<form method="POST" action="{{ route('purchase-orders.store') }}" x-data="lineItems({{ $variants->toJson() }})">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="lg:col-span-2">
            <x-card>
                <h3 class="font-bold mb-4">Order Items</h3>
                @include('partials.line-item-picker', ['withCost' => true])
            </x-card>
        </div>
        <div class="space-y-5">
            <x-card>
                <h3 class="font-bold mb-4">Order Details</h3>
                <div class="space-y-4">
                    <x-field label="Supplier" name="supplier_id" type="select" required>
                        <option value="">— Select —</option>
                        @foreach ($suppliers as $s)<option value="{{ $s->id }}">{{ $s->name }}</option>@endforeach
                    </x-field>
                    <x-field label="Order Date" name="order_date" type="date" :value="now()->toDateString()" required />
                    <x-field label="Expected Date" name="expected_date" type="date" />
                    <x-field label="Tax Amount" name="tax" type="number" value="0" />
                    <x-field label="Notes" name="notes" type="textarea" />
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                    <span class="text-slate-500">Subtotal</span>
                    <span class="text-xl font-extrabold text-brand-600" x-text="formatMoney(total)"></span>
                </div>
            </x-card>
            <div class="flex flex-col gap-2">
                <x-btn type="submit">Create Purchase Order</x-btn>
                <x-btn href="{{ route('purchase-orders.index') }}" variant="secondary">Cancel</x-btn>
            </div>
        </div>
    </div>
</form>
@endsection
