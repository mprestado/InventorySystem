@extends('layouts.app')
@section('title', 'Purchase Order')
@php $statusColors = ['pending'=>'amber','approved'=>'blue','ordered'=>'purple','partially_received'=>'amber','completed'=>'green','cancelled'=>'red']; @endphp
@section('content')
<x-page-header title="{{ $order->po_number }}" subtitle="{{ $order->supplier?->name }} · {{ $order->order_date->format('M d, Y') }}">
    @if (!in_array($order->status, ['completed','cancelled']))
        <x-btn href="{{ route('purchase-orders.receive', $order) }}" variant="success">Receive Items</x-btn>
    @endif
</x-page-header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <div class="lg:col-span-2">
        <x-card padding="p-0">
            <div class="p-5 flex items-center justify-between border-b border-slate-200 dark:border-slate-800">
                <h3 class="font-bold">Order Items</h3>
                <x-badge color="{{ $statusColors[$order->status] ?? 'slate' }}">{{ \App\Models\PurchaseOrder::STATUSES[$order->status] ?? $order->status }}</x-badge>
            </div>
            <table class="w-full text-sm">
                <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                    <tr><th class="px-5 py-2.5 font-medium">Product</th><th class="px-5 py-2.5 font-medium">Ordered</th><th class="px-5 py-2.5 font-medium">Received</th><th class="px-5 py-2.5 font-medium">Cost</th><th class="px-5 py-2.5 font-medium text-right">Total</th></tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ($order->items as $item)
                        <tr><td class="px-5 py-2.5 font-medium">{{ $item->variant?->display_name ?? '—' }}</td>
                            <td class="px-5 py-2.5">{{ $item->quantity }}</td>
                            <td class="px-5 py-2.5">{{ $item->received_quantity }}</td>
                            <td class="px-5 py-2.5">{{ money($item->unit_cost) }}</td>
                            <td class="px-5 py-2.5 text-right font-semibold">{{ money($item->total) }}</td></tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-5 space-y-1 text-sm border-t border-slate-200 dark:border-slate-800">
                <div class="flex justify-between"><span class="text-slate-500">Subtotal</span><span>{{ money($order->subtotal) }}</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Tax</span><span>{{ money($order->tax) }}</span></div>
                <div class="flex justify-between text-lg font-extrabold pt-2"><span>Total</span><span class="text-brand-600">{{ money($order->total) }}</span></div>
            </div>
        </x-card>
    </div>
    <div class="space-y-5">
        <x-card>
            <h3 class="font-bold mb-4">Update Status</h3>
            <form method="POST" action="{{ route('purchase-orders.status', $order) }}" class="flex gap-2">
                @csrf
                <select name="status" class="flex-1 px-3 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
                    @foreach (\App\Models\PurchaseOrder::STATUSES as $k => $v)<option value="{{ $k }}" @selected($order->status==$k)>{{ $v }}</option>@endforeach
                </select>
                <x-btn type="submit" variant="secondary">Set</x-btn>
            </form>
            <dl class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 space-y-2 text-sm">
                <div class="flex justify-between"><dt class="text-slate-400">Created by</dt><dd>{{ $order->creator?->name ?? '—' }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-400">Approved by</dt><dd>{{ $order->approver?->name ?? '—' }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-400">Expected</dt><dd>{{ $order->expected_date?->format('M d, Y') ?? '—' }}</dd></div>
            </dl>
            @if($order->notes)<p class="mt-4 text-sm text-slate-500">{{ $order->notes }}</p>@endif
        </x-card>
        <form method="POST" action="{{ route('purchase-orders.destroy', $order) }}" onsubmit="return confirm('Delete this purchase order?')">
            @csrf @method('DELETE')
            <x-btn variant="danger" type="submit" class="w-full">Delete Order</x-btn>
        </form>
    </div>
</div>
@endsection
