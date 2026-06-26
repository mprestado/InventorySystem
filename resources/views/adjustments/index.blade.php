@extends('layouts.app')
@section('title', 'Inventory Adjustments')
@section('content')
<x-page-header title="Inventory Adjustments" subtitle="Add, remove, or correct stock with full audit trail">
    <x-btn href="{{ route('adjustments.create') }}">＋ New Adjustment</x-btn>
</x-page-header>
<x-card padding="p-0">
    @if ($adjustments->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">Reference</th><th class="px-5 py-3 font-medium">Type</th><th class="px-5 py-3 font-medium">Reason</th><th class="px-5 py-3 font-medium">Date</th><th class="px-5 py-3 font-medium">Items</th><th class="px-5 py-3 font-medium">User</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($adjustments as $a)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3"><a href="{{ route('adjustments.show', $a) }}" class="text-brand-600 font-semibold">{{ $a->reference_no }}</a></td>
                        <td class="px-5 py-3"><x-badge color="{{ $a->type==='add'?'green':($a->type==='remove'?'red':'blue') }}">{{ \App\Models\Adjustment::TYPES[$a->type] ?? $a->type }}</x-badge></td>
                        <td class="px-5 py-3">{{ $a->reason }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $a->date->format('M d, Y') }}</td>
                        <td class="px-5 py-3">{{ $a->items_count }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $a->user?->name ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $adjustments->links() }}</div>
    @else <x-empty message="No adjustments yet." /> @endif
</x-card>
@endsection
