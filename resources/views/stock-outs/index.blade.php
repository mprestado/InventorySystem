@extends('layouts.app')
@section('title', 'Stock Out')
@section('content')
<x-page-header title="Stock Out" subtitle="Outgoing inventory records">
    <x-btn href="{{ route('stock-outs.create') }}">＋ Record Stock Out</x-btn>
</x-page-header>
<x-card padding="p-0">
    @if ($stockOuts->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">Reference</th><th class="px-5 py-3 font-medium">Reason</th><th class="px-5 py-3 font-medium">Date</th><th class="px-5 py-3 font-medium">Items</th><th class="px-5 py-3 font-medium">Handled By</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($stockOuts as $so)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3"><a href="{{ route('stock-outs.show', $so) }}" class="text-brand-600 font-semibold">{{ $so->reference_no }}</a></td>
                        <td class="px-5 py-3"><x-badge color="amber">{{ \App\Models\StockOut::REASONS[$so->reason] ?? $so->reason }}</x-badge></td>
                        <td class="px-5 py-3 text-slate-500">{{ $so->date->format('M d, Y') }}</td>
                        <td class="px-5 py-3">{{ $so->items_count }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $so->handler?->name ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $stockOuts->links() }}</div>
    @else <x-empty message="No stock-out records yet." /> @endif
</x-card>
@endsection
