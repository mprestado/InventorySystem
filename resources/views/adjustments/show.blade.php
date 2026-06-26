@extends('layouts.app')
@section('title', 'Adjustment Details')
@section('content')
<x-page-header title="Adjustment · {{ $adjustment->reference_no }}" subtitle="{{ \App\Models\Adjustment::TYPES[$adjustment->type] ?? $adjustment->type }} · {{ $adjustment->date->format('M d, Y') }}">
    <x-delete :action="route('adjustments.destroy', $adjustment)" />
</x-page-header>
<x-card class="mb-5">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
        <div><p class="text-slate-400">Reason</p><p class="font-semibold">{{ $adjustment->reason }}</p></div>
        <div><p class="text-slate-400">User</p><p class="font-semibold">{{ $adjustment->user?->name ?? '—' }}</p></div>
        <div><p class="text-slate-400">Date</p><p class="font-semibold">{{ $adjustment->date->format('M d, Y') }}</p></div>
        <div><p class="text-slate-400">Remarks</p><p class="font-semibold">{{ $adjustment->remarks ?? '—' }}</p></div>
    </div>
</x-card>
<x-card>
    <table class="w-full text-sm">
        <thead class="text-left text-slate-400 border-b border-slate-200 dark:border-slate-800">
            <tr><th class="pb-2 font-medium">Product</th><th class="pb-2 font-medium">Before</th><th class="pb-2 font-medium">After</th><th class="pb-2 font-medium text-right">Change</th></tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
            @foreach ($adjustment->items as $item)
                <tr><td class="py-2.5 font-medium">{{ $item->variant?->display_name ?? '—' }}</td>
                    <td class="py-2.5 text-slate-500">{{ $item->quantity_before }}</td>
                    <td class="py-2.5 font-semibold">{{ $item->quantity_after }}</td>
                    <td class="py-2.5 text-right font-semibold {{ $item->difference>=0?'text-emerald-600':'text-rose-600' }}">{{ $item->difference>=0?'+':'' }}{{ $item->difference }}</td></tr>
            @endforeach
        </tbody>
    </table>
</x-card>
@endsection
