@extends('layouts.app')
@section('title', 'Brands')
@section('content')
<x-page-header title="Brands" subtitle="{{ $brands->total() }} brands">
    <x-btn href="{{ route('brands.create') }}">＋ Add Brand</x-btn>
</x-page-header>
<x-card padding="p-0">
    <div class="p-4 border-b border-slate-200 dark:border-slate-800">
        <form method="GET" class="flex gap-2 max-w-md">
            <input name="search" value="{{ request('search') }}" placeholder="Search brands…" class="flex-1 px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
            <x-btn type="submit" variant="secondary">Search</x-btn>
        </form>
    </div>
    @if ($brands->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">Name</th><th class="px-5 py-3 font-medium">Products</th><th class="px-5 py-3 font-medium">Status</th><th class="px-5 py-3 font-medium text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($brands as $b)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3 font-semibold">{{ $b->name }}<p class="text-xs text-slate-400 font-normal">{{ Str::limit($b->description, 60) }}</p></td>
                        <td class="px-5 py-3">{{ $b->products_count }}</td>
                        <td class="px-5 py-3">@if($b->status==='active')<x-badge color="green">Active</x-badge>@else<x-badge color="amber">Archived</x-badge>@endif</td>
                        <td class="px-5 py-3"><div class="flex items-center justify-end gap-1">
                            <x-btn href="{{ route('brands.edit', $b) }}" variant="ghost" class="!px-2.5 !py-1.5 text-xs">Edit</x-btn>
                            <x-delete :action="route('brands.destroy', $b)" />
                        </div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $brands->links() }}</div>
    @else <x-empty message="No brands yet." /> @endif
</x-card>
@endsection
