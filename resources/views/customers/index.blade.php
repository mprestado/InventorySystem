@extends('layouts.app')
@section('title', 'Customers')
@section('content')
<x-page-header title="Customers" subtitle="{{ $customers->total() }} customers">
    <x-btn href="{{ route('customers.create') }}">＋ Add Customer</x-btn>
</x-page-header>
<x-card padding="p-0">
    <div class="p-4 border-b border-slate-200 dark:border-slate-800">
        <form method="GET" class="flex gap-2 max-w-md">
            <input name="search" value="{{ request('search') }}" placeholder="Search by name or phone…" class="flex-1 px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
            <x-btn type="submit" variant="secondary">Search</x-btn>
        </form>
    </div>
    @if ($customers->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">Name</th><th class="px-5 py-3 font-medium">Phone</th><th class="px-5 py-3 font-medium">Orders</th><th class="px-5 py-3 font-medium">Total Spent</th><th class="px-5 py-3 font-medium text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($customers as $c)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3 font-semibold"><a href="{{ route('customers.show', $c) }}" class="hover:text-brand-600">{{ $c->name }}</a></td>
                        <td class="px-5 py-3 text-slate-500">{{ $c->phone ?? '—' }}</td>
                        <td class="px-5 py-3">{{ $c->sales_count }}</td>
                        <td class="px-5 py-3 font-semibold">{{ money($c->sales_sum_total ?? 0) }}</td>
                        <td class="px-5 py-3"><div class="flex items-center justify-end gap-1">
                            <x-btn href="{{ route('customers.edit', $c) }}" variant="ghost" class="!px-2.5 !py-1.5 text-xs">Edit</x-btn>
                            <x-delete :action="route('customers.destroy', $c)" />
                        </div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $customers->links() }}</div>
    @else <x-empty message="No customers yet." /> @endif
</x-card>
@endsection
