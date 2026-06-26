@extends('layouts.app')
@section('title', 'Suppliers')
@section('content')
<x-page-header title="Suppliers" subtitle="{{ $suppliers->total() }} suppliers">
    <x-btn href="{{ route('suppliers.create') }}">＋ Add Supplier</x-btn>
</x-page-header>
<x-card padding="p-0">
    <div class="p-4 border-b border-slate-200 dark:border-slate-800">
        <form method="GET" class="flex gap-2 max-w-md">
            <input name="search" value="{{ request('search') }}" placeholder="Search suppliers…" class="flex-1 px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
            <x-btn type="submit" variant="secondary">Search</x-btn>
        </form>
    </div>
    @if ($suppliers->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">Supplier</th><th class="px-5 py-3 font-medium">Contact</th><th class="px-5 py-3 font-medium">Phone</th><th class="px-5 py-3 font-medium">Products</th><th class="px-5 py-3 font-medium text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($suppliers as $s)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3 font-semibold"><a href="{{ route('suppliers.show', $s) }}" class="hover:text-brand-600">{{ $s->name }}</a></td>
                        <td class="px-5 py-3 text-slate-500">{{ $s->contact_person ?? '—' }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $s->phone ?? '—' }}</td>
                        <td class="px-5 py-3">{{ $s->products_count }}</td>
                        <td class="px-5 py-3"><div class="flex items-center justify-end gap-1">
                            <x-btn href="{{ route('suppliers.edit', $s) }}" variant="ghost" class="!px-2.5 !py-1.5 text-xs">Edit</x-btn>
                            <x-delete :action="route('suppliers.destroy', $s)" />
                        </div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $suppliers->links() }}</div>
    @else <x-empty message="No suppliers yet." /> @endif
</x-card>
@endsection
