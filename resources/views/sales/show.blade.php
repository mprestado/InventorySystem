@extends('layouts.app')
@section('title', 'Sale Details')
@section('content')
<x-page-header title="{{ $sale->invoice_number }}" subtitle="{{ $sale->sale_date->format('M d, Y H:i') }}">
    <x-btn href="{{ route('sales.receipt', $sale) }}" variant="secondary" target="_blank">View Receipt</x-btn>
</x-page-header>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <x-card class="lg:col-span-2">
        <h3 class="font-bold mb-4">Items</h3>
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 border-b border-slate-200 dark:border-slate-800">
                <tr><th class="pb-2 font-medium">Product</th><th class="pb-2 font-medium">Qty</th><th class="pb-2 font-medium">Price</th><th class="pb-2 font-medium text-right">Total</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($sale->items as $item)
                    <tr><td class="py-2.5 font-medium">{{ $item->variant?->display_name ?? '—' }}</td>
                        <td class="py-2.5">{{ $item->quantity }}</td>
                        <td class="py-2.5">{{ money($item->unit_price) }}</td>
                        <td class="py-2.5 text-right font-semibold">{{ money($item->total) }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
    <x-card>
        <h3 class="font-bold mb-4">Summary</h3>
        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-slate-400">Customer</dt><dd class="font-medium">{{ $sale->customer?->name ?? 'Walk-in' }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-400">Cashier</dt><dd class="font-medium">{{ $sale->cashier?->name ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-400">Payment</dt><dd class="font-medium">{{ ucfirst($sale->payment_method) }}</dd></div>
            <div class="flex justify-between pt-2 border-t border-slate-100 dark:border-slate-800"><dt class="text-slate-400">Subtotal</dt><dd>{{ money($sale->subtotal) }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-400">Tax</dt><dd>{{ money($sale->tax) }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-400">Discount</dt><dd>{{ money($sale->discount) }}</dd></div>
            <div class="flex justify-between text-lg font-extrabold pt-2"><dt>Total</dt><dd class="text-brand-600">{{ money($sale->total) }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-400">Paid</dt><dd>{{ money($sale->amount_paid) }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-400">Change</dt><dd>{{ money($sale->change_due) }}</dd></div>
        </dl>
    </x-card>
</div>
@endsection
