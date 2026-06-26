@extends('layouts.app')
@section('title', 'Users & Roles')
@section('content')
<x-page-header title="Users & Roles" subtitle="{{ $users->total() }} users">
    <x-btn href="{{ route('users.create') }}">＋ Add User</x-btn>
</x-page-header>
<x-card padding="p-0">
    <div class="p-4 border-b border-slate-200 dark:border-slate-800">
        <form method="GET" class="flex gap-2 max-w-md">
            <input name="search" value="{{ request('search') }}" placeholder="Search users…" class="flex-1 px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
            <x-btn type="submit" variant="secondary">Search</x-btn>
        </form>
    </div>
    @if ($users->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-slate-400 bg-slate-50 dark:bg-slate-800/50">
                <tr><th class="px-5 py-3 font-medium">User</th><th class="px-5 py-3 font-medium">Role</th><th class="px-5 py-3 font-medium">Status</th><th class="px-5 py-3 font-medium text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($users as $u)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $u->avatar_url }}" class="w-9 h-9 rounded-full object-cover">
                                <div><p class="font-semibold">{{ $u->name }}</p><p class="text-xs text-slate-400">{{ $u->email }}</p></div>
                            </div>
                        </td>
                        <td class="px-5 py-3"><x-badge color="purple">{{ $u->roles->pluck('name')->implode(', ') ?: '—' }}</x-badge></td>
                        <td class="px-5 py-3">@if($u->status==='active')<x-badge color="green">Active</x-badge>@else<x-badge color="red">Inactive</x-badge>@endif</td>
                        <td class="px-5 py-3"><div class="flex items-center justify-end gap-1">
                            <x-btn href="{{ route('users.edit', $u) }}" variant="ghost" class="!px-2.5 !py-1.5 text-xs">Edit</x-btn>
                            @if ($u->id !== auth()->id())<x-delete :action="route('users.destroy', $u)" message="Delete {{ $u->name }}?" />@endif
                        </div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $users->links() }}</div>
    @else <x-empty message="No users." /> @endif
</x-card>
@endsection
