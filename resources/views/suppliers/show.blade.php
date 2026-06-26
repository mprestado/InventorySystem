@extends('layouts.app')
@section('title', 'Supplier')
@section('content')
<x-page-header title="{{ $supplier->name }}" subtitle="Supplier profile">
    <x-btn href="{{ route('suppliers.edit', $supplier) }}">Edit</x-btn>
</x-page-header>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <x-card>
        <h3 class="font-bold mb-4">Contact Details</h3>
        <dl class="space-y-3 text-sm">
            <div><dt class="text-slate-400">Contact Person</dt><dd class="font-medium">{{ $supplier->contact_person ?? '—' }}</dd></div>
            <div><dt class="text-slate-400">Phone</dt><dd class="font-medium">{{ $supplier->phone ?? '—' }}</dd></div>
            <div><dt class="text-slate-400">Email</dt><dd class="font-medium">{{ $supplier->email ?? '—' }}</dd></div>
            <div><dt class="text-slate-400">Address</dt><dd class="font-medium">{{ $supplier->address ?? '—' }}</dd></div>
            @if($supplier->notes)<div><dt class="text-slate-400">Notes</dt><dd>{{ $supplier->notes }}</dd></div>@endif
        </dl>
    </x-card>
    <x-card class="lg:col-span-2">
        <h3 class="font-bold mb-4">Recent Purchase Orders</h3>
        @if ($supplier->purchaseOrders->count())
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 border-b border-slate-200 dark:border-slate-800">
                <tr><th class="pb-2 font-medium">PO #</th><th class="pb-2 font-medium">Date</th><th class="pb-2 font-medium">Status</th><th class="pb-2 font-medium text-right">Total</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($supplier->purchaseOrders as $po)
                    <tr><td class="py-2.5"><a href="{{ route('purchase-orders.show', $po) }}" class="text-brand-600 font-medium">{{ $po->po_number }}</a></td>
                        <td class="py-2.5 text-slate-500">{{ $po->order_date->format('M d, Y') }}</td>
                        <td class="py-2.5"><x-badge>{{ \App\Models\PurchaseOrder::STATUSES[$po->status] ?? $po->status }}</x-badge></td>
                        <td class="py-2.5 text-right font-semibold">{{ money($po->total) }}</td></tr>
                @endforeach
            </tbody>
        </table>
        @else <p class="text-sm text-slate-400 py-6 text-center">No purchase orders yet.</p> @endif
    </x-card>
</div>
@endsection
