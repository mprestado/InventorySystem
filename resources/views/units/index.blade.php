@extends('layouts.app')
@section('title', 'Units')
@section('content')
<x-page-header title="Units of Measure" subtitle="Piece, Box, Set, etc.">
    <x-btn href="{{ route('units.create') }}">＋ Add Unit</x-btn>
</x-page-header>
<x-card padding="p-0">
    @if ($units->count())
    <table class="w-full text-sm">
        <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
            <tr><th class="px-5 py-3 font-medium">Name</th><th class="px-5 py-3 font-medium">Abbreviation</th><th class="px-5 py-3 font-medium">Products</th><th class="px-5 py-3 font-medium text-right">Actions</th></tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
            @foreach ($units as $u)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                    <td class="px-5 py-3 font-semibold">{{ $u->name }}</td>
                    <td class="px-5 py-3"><x-badge>{{ $u->abbreviation }}</x-badge></td>
                    <td class="px-5 py-3">{{ $u->products_count }}</td>
                    <td class="px-5 py-3"><div class="flex items-center justify-end gap-1">
                        <x-btn href="{{ route('units.edit', $u) }}" variant="ghost" class="!px-2.5 !py-1.5 text-xs">Edit</x-btn>
                        <x-delete :action="route('units.destroy', $u)" />
                    </div></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $units->links() }}</div>
    @else <x-empty message="No units yet." /> @endif
</x-card>
@endsection
