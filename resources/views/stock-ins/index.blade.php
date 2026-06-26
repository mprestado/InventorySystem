@extends('layouts.app')
@section('title', 'Stock In')
@section('content')
<x-page-header title="Stock In" subtitle="Incoming inventory records">
    <x-btn href="{{ route('stock-ins.create') }}">＋ Receive Stock</x-btn>
</x-page-header>
<x-card padding="p-0">
    @if ($stockIns->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">Reference</th><th class="px-5 py-3 font-medium">Supplier</th><th class="px-5 py-3 font-medium">Invoice</th><th class="px-5 py-3 font-medium">Date</th><th class="px-5 py-3 font-medium">Items</th><th class="px-5 py-3 font-medium">Received By</th><th class="px-5 py-3 font-medium text-right">Total Cost</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($stockIns as $si)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3"><a href="{{ route('stock-ins.show', $si) }}" class="text-brand-600 font-semibold">{{ $si->reference_no }}</a></td>
                        <td class="px-5 py-3">{{ $si->supplier?->name ?? '—' }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $si->invoice_number ?? '—' }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $si->received_date->format('M d, Y') }}</td>
                        <td class="px-5 py-3">{{ $si->items_count }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $si->receiver?->name ?? '—' }}</td>
                        <td class="px-5 py-3 text-right font-semibold">{{ money($si->total_cost) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $stockIns->links() }}</div>
    @else <x-empty message="No stock-in records yet." /> @endif
</x-card>
@endsection
