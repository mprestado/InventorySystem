@extends('layouts.app')
@section('title', 'Receive Items')
@section('content')
<x-page-header title="Receive Items · {{ $order->po_number }}" subtitle="Enter quantities received — stock updates automatically" />
<form method="POST" action="{{ route('purchase-orders.receive', $order) }}">
    @csrf
    <x-card class="max-w-3xl">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 border-b border-slate-200 dark:border-slate-800">
                <tr><th class="pb-2 font-medium">Product</th><th class="pb-2 font-medium">Ordered</th><th class="pb-2 font-medium">Already Received</th><th class="pb-2 font-medium">Receive Now</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($order->items as $item)
                    @php $remaining = $item->quantity - $item->received_quantity; @endphp
                    <tr>
                        <td class="py-3 font-medium">{{ $item->variant?->display_name ?? '—' }}</td>
                        <td class="py-3">{{ $item->quantity }}</td>
                        <td class="py-3">{{ $item->received_quantity }}</td>
                        <td class="py-3">
                            <input type="number" name="received[{{ $item->id }}]" min="0" max="{{ $remaining }}" value="{{ $remaining }}"
                                   class="w-24 px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none" {{ $remaining<=0?'disabled':'' }}>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex gap-2 mt-5">
            <x-btn type="submit" variant="success">Receive into Inventory</x-btn>
            <x-btn href="{{ route('purchase-orders.show', $order) }}" variant="secondary">Cancel</x-btn>
        </div>
    </x-card>
</form>
@endsection
