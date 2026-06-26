@extends('layouts.app')
@section('title', 'Stock In Details')
@section('content')
<x-page-header title="Stock In · {{ $stockIn->reference_no }}" subtitle="Received {{ $stockIn->received_date->format('M d, Y') }}">
    <x-delete :action="route('stock-ins.destroy', $stockIn)" message="Delete this record? (Stock already moved is not reverted)" />
</x-page-header>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <x-card>
        <h3 class="font-bold mb-4">Summary</h3>
        <dl class="space-y-3 text-sm">
            <div class="flex justify-between"><dt class="text-slate-400">Supplier</dt><dd class="font-medium">{{ $stockIn->supplier?->name ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-400">Invoice #</dt><dd class="font-medium">{{ $stockIn->invoice_number ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-400">Received By</dt><dd class="font-medium">{{ $stockIn->receiver?->name ?? '—' }}</dd></div>
            <div class="flex justify-between pt-3 border-t border-slate-100 dark:border-slate-800"><dt class="text-slate-400">Total Cost</dt><dd class="text-lg font-extrabold text-brand-600">{{ money($stockIn->total_cost) }}</dd></div>
        </dl>
        @if($stockIn->notes)<p class="mt-4 text-sm text-slate-500">{{ $stockIn->notes }}</p>@endif
    </x-card>
    <x-card class="lg:col-span-2">
        <h3 class="font-bold mb-4">Items</h3>
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 border-b border-slate-200 dark:border-slate-800">
                <tr><th class="pb-2 font-medium">Product</th><th class="pb-2 font-medium">Qty</th><th class="pb-2 font-medium">Unit Cost</th><th class="pb-2 font-medium text-right">Total</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($stockIn->items as $item)
                    <tr><td class="py-2.5 font-medium">{{ $item->variant?->display_name ?? '—' }}</td>
                        <td class="py-2.5">{{ $item->quantity }}</td>
                        <td class="py-2.5">{{ money($item->unit_cost) }}</td>
                        <td class="py-2.5 text-right font-semibold">{{ money($item->total) }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
</div>
@endsection
