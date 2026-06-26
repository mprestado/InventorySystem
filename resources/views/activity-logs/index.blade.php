@extends('layouts.app')
@section('title', 'Activity Logs')
@section('content')
<x-page-header title="Activity Logs" subtitle="Complete audit trail of system actions" />
<x-card class="mb-5" padding="p-4">
    <form method="GET" class="flex flex-wrap gap-2">
        <input name="search" value="{{ request('search') }}" placeholder="Search description…" class="px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
        <select name="action" class="px-3 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
            <option value="">All Actions</option>
            @foreach ($actions as $a)<option value="{{ $a }}" @selected(request('action')==$a)>{{ ucfirst(str_replace('_',' ',$a)) }}</option>@endforeach
        </select>
        <select name="user_id" class="px-3 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
            <option value="">All Users</option>
            @foreach ($users as $u)<option value="{{ $u->id }}" @selected(request('user_id')==$u->id)>{{ $u->name }}</option>@endforeach
        </select>
        <x-btn type="submit" variant="secondary">Filter</x-btn>
    </form>
</x-card>
<x-card padding="p-0">
    @if ($logs->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">When</th><th class="px-5 py-3 font-medium">User</th><th class="px-5 py-3 font-medium">Action</th><th class="px-5 py-3 font-medium">Description</th><th class="px-5 py-3 font-medium">IP</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($logs as $log)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3 text-slate-500 whitespace-nowrap">{{ $log->created_at?->format('M d, Y H:i') }}</td>
                        <td class="px-5 py-3 font-medium">{{ $log->user?->name ?? 'System' }}</td>
                        <td class="px-5 py-3"><x-badge color="blue">{{ ucfirst(str_replace('_',' ',$log->action)) }}</x-badge></td>
                        <td class="px-5 py-3">{{ $log->description }}</td>
                        <td class="px-5 py-3 text-slate-400 font-mono text-xs">{{ $log->ip_address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $logs->links() }}</div>
    @else <x-empty message="No activity logged yet." /> @endif
</x-card>
@endsection
