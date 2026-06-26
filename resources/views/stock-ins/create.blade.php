@extends('layouts.app')
@section('title', 'Receive Stock')
@section('content')
<x-page-header title="Receive Stock" subtitle="Record incoming products — inventory updates automatically" />

<form method="POST" action="{{ route('stock-ins.store') }}" x-data="lineItems({{ $variants->toJson() }})">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="lg:col-span-2 space-y-5">
            <x-card>
                <h3 class="font-bold mb-4">Items Received</h3>
                @include('partials.line-item-picker', ['withCost' => true])
            </x-card>
        </div>
        <div class="space-y-5">
            <x-card>
                <h3 class="font-bold mb-4">Details</h3>
                <div class="space-y-4">
                    <x-field label="Supplier" name="supplier_id" type="select">
                        <option value="">— Select —</option>
                        @foreach ($suppliers as $s)<option value="{{ $s->id }}">{{ $s->name }}</option>@endforeach
                    </x-field>
                    <x-field label="Invoice Number" name="invoice_number" />
                    <x-field label="Date Received" name="received_date" type="date" :value="now()->toDateString()" required />
                    <x-field label="Notes" name="notes" type="textarea" />
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                    <span class="text-slate-500">Total Cost</span>
                    <span class="text-xl font-extrabold text-brand-600" x-text="formatMoney(total)"></span>
                </div>
            </x-card>
            <div class="flex flex-col gap-2">
                <x-btn type="submit">Save & Update Stock</x-btn>
                <x-btn href="{{ route('stock-ins.index') }}" variant="secondary">Cancel</x-btn>
            </div>
        </div>
    </div>
</form>
@endsection
