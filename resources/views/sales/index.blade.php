@extends('layouts.app')
@section('title', 'Sales History')
@section('content')
<x-page-header title="Sales History" subtitle="{{ $sales->total() }} transactions">
    @can('process sales')<x-btn href="{{ route('pos') }}">＋ New Sale</x-btn>@endcan
</x-page-header>
<x-card padding="p-0">
    <div class="p-4 border-b border-slate-200 dark:border-slate-800">
        <form method="GET" class="flex flex-wrap gap-2">
            <input name="search" value="{{ request('search') }}" placeholder="Invoice #…" class="px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
            <input name="date" type="date" value="{{ request('date') }}" class="px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
            <x-btn type="submit" variant="secondary">Filter</x-btn>
        </form>
    </div>
    @if ($sales->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">Invoice</th><th class="px-5 py-3 font-medium">Date</th><th class="px-5 py-3 font-medium">Customer</th><th class="px-5 py-3 font-medium">Cashier</th><th class="px-5 py-3 font-medium">Payment</th><th class="px-5 py-3 font-medium text-right">Total</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($sales as $sale)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3"><a href="{{ route('sales.show', $sale) }}" class="text-brand-600 font-semibold">{{ $sale->invoice_number }}</a></td>
                        <td class="px-5 py-3 text-slate-500">{{ $sale->sale_date->format('M d, Y H:i') }}</td>
                        <td class="px-5 py-3">{{ $sale->customer?->name ?? 'Walk-in' }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $sale->cashier?->name ?? '—' }}</td>
                        <td class="px-5 py-3"><x-badge>{{ ucfirst($sale->payment_method) }}</x-badge></td>
                        <td class="px-5 py-3 text-right font-bold">{{ money($sale->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $sales->links() }}</div>
    @else <x-empty message="No sales recorded yet." /> @endif
</x-card>
@endsection
