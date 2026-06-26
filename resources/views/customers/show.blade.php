@extends('layouts.app')
@section('title', 'Customer')
@section('content')
<x-page-header title="{{ $customer->name }}" subtitle="Customer profile & purchase history">
    <x-btn href="{{ route('customers.edit', $customer) }}">Edit</x-btn>
</x-page-header>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <x-card>
        <h3 class="font-bold mb-4">Details</h3>
        <dl class="space-y-3 text-sm">
            <div><dt class="text-slate-400">Phone</dt><dd class="font-medium">{{ $customer->phone ?? '—' }}</dd></div>
            <div><dt class="text-slate-400">Email</dt><dd class="font-medium">{{ $customer->email ?? '—' }}</dd></div>
            <div><dt class="text-slate-400">Address</dt><dd class="font-medium">{{ $customer->address ?? '—' }}</dd></div>
            <div class="pt-3 border-t border-slate-100 dark:border-slate-800"><dt class="text-slate-400">Total Spent</dt><dd class="text-2xl font-extrabold text-brand-600">{{ money($customer->total_spent) }}</dd></div>
        </dl>
    </x-card>
    <x-card class="lg:col-span-2">
        <h3 class="font-bold mb-4">Purchase History</h3>
        @if ($customer->sales->count())
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 border-b border-slate-200 dark:border-slate-800">
                <tr><th class="pb-2 font-medium">Invoice</th><th class="pb-2 font-medium">Date</th><th class="pb-2 font-medium">Items</th><th class="pb-2 font-medium text-right">Total</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($customer->sales as $sale)
                    <tr><td class="py-2.5"><a href="{{ route('sales.show', $sale) }}" class="text-brand-600 font-medium">{{ $sale->invoice_number }}</a></td>
                        <td class="py-2.5 text-slate-500">{{ $sale->sale_date->format('M d, Y') }}</td>
                        <td class="py-2.5">{{ $sale->items->count() }}</td>
                        <td class="py-2.5 text-right font-semibold">{{ money($sale->total) }}</td></tr>
                @endforeach
            </tbody>
        </table>
        @else <p class="text-sm text-slate-400 py-6 text-center">No purchases yet.</p> @endif
    </x-card>
</div>
@endsection
