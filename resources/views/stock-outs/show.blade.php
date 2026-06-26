@extends('layouts.app')
@section('title', 'Stock Out Details')
@section('content')
<x-page-header title="Stock Out · {{ $stockOut->reference_no }}" subtitle="{{ \App\Models\StockOut::REASONS[$stockOut->reason] ?? $stockOut->reason }} · {{ $stockOut->date->format('M d, Y') }}">
    <x-delete :action="route('stock-outs.destroy', $stockOut)" />
</x-page-header>
<x-card>
    <table class="w-full text-sm">
        <thead class="text-left text-slate-400 border-b border-slate-200 dark:border-slate-800">
            <tr><th class="pb-2 font-medium">Product</th><th class="pb-2 font-medium">Qty</th><th class="pb-2 font-medium text-right">Unit Cost</th></tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
            @foreach ($stockOut->items as $item)
                <tr><td class="py-2.5 font-medium">{{ $item->variant?->display_name ?? '—' }}</td>
                    <td class="py-2.5">{{ $item->quantity }}</td>
                    <td class="py-2.5 text-right">{{ money($item->unit_cost) }}</td></tr>
            @endforeach
        </tbody>
    </table>
    @if($stockOut->remarks)<p class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 text-sm text-slate-500">{{ $stockOut->remarks }}</p>@endif
</x-card>
@endsection
