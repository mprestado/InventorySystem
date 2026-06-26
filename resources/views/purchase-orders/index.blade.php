@extends('layouts.app')
@section('title', 'Purchase Orders')
@section('content')
<x-page-header title="Purchase Orders" subtitle="{{ $orders->total() }} orders">
    <x-btn href="{{ route('purchase-orders.create') }}">＋ New Purchase Order</x-btn>
</x-page-header>
@php $statusColors = ['pending'=>'amber','approved'=>'blue','ordered'=>'purple','partially_received'=>'amber','completed'=>'green','cancelled'=>'red']; @endphp
<x-card padding="p-0">
    @if ($orders->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">PO #</th><th class="px-5 py-3 font-medium">Supplier</th><th class="px-5 py-3 font-medium">Order Date</th><th class="px-5 py-3 font-medium">Status</th><th class="px-5 py-3 font-medium">Items</th><th class="px-5 py-3 font-medium text-right">Total</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($orders as $po)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3"><a href="{{ route('purchase-orders.show', $po) }}" class="text-brand-600 font-semibold">{{ $po->po_number }}</a></td>
                        <td class="px-5 py-3">{{ $po->supplier?->name ?? '—' }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $po->order_date->format('M d, Y') }}</td>
                        <td class="px-5 py-3"><x-badge color="{{ $statusColors[$po->status] ?? 'slate' }}">{{ \App\Models\PurchaseOrder::STATUSES[$po->status] ?? $po->status }}</x-badge></td>
                        <td class="px-5 py-3">{{ $po->items_count }}</td>
                        <td class="px-5 py-3 text-right font-semibold">{{ money($po->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $orders->links() }}</div>
    @else <x-empty message="No purchase orders yet." /> @endif
</x-card>
@endsection
