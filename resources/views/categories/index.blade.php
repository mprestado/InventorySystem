@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<x-page-header title="Categories" subtitle="{{ $categories->total() }} categories">
    <x-btn href="{{ route('categories.create') }}">＋ Add Category</x-btn>
</x-page-header>

<x-card padding="p-0">
    <div class="p-4 border-b border-slate-200 dark:border-slate-800">
        <form method="GET" class="flex gap-2 max-w-md">
            <input name="search" value="{{ request('search') }}" placeholder="Search categories…" class="flex-1 px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
            <x-btn type="submit" variant="secondary">Search</x-btn>
        </form>
    </div>
    @if ($categories->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">Name</th><th class="px-5 py-3 font-medium">Parent</th><th class="px-5 py-3 font-medium">Products</th><th class="px-5 py-3 font-medium">Status</th><th class="px-5 py-3 font-medium text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($categories as $c)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3 font-semibold">{{ $c->name }}<p class="text-xs text-slate-400 font-normal">{{ $c->description ? Str::limit($c->description, 50) : '' }}</p></td>
                        <td class="px-5 py-3 text-slate-500">{{ $c->parent?->name ?? '—' }}</td>
                        <td class="px-5 py-3">{{ $c->products_count }}</td>
                        <td class="px-5 py-3">@if($c->status==='active')<x-badge color="green">Active</x-badge>@else<x-badge color="amber">Archived</x-badge>@endif</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <form method="POST" action="{{ route('categories.archive', $c) }}">@csrf @method('PATCH')
                                    <button class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700" title="Toggle archive">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                    </button>
                                </form>
                                <x-btn href="{{ route('categories.edit', $c) }}" variant="ghost" class="!px-2.5 !py-1.5 text-xs">Edit</x-btn>
                                <x-delete :action="route('categories.destroy', $c)" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $categories->links() }}</div>
    @else <x-empty message="No categories yet." /> @endif
</x-card>
@endsection
