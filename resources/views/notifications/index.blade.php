@extends('layouts.app')
@section('title', 'Notifications')
@section('content')
<x-page-header title="Notifications">
    <form method="POST" action="{{ route('notifications.readAll') }}">@csrf
        <x-btn type="submit" variant="secondary">Mark all as read</x-btn>
    </form>
</x-page-header>
<x-card padding="p-0">
    @if ($notifications->count())
    <div class="divide-y divide-slate-100 dark:divide-slate-800">
        @foreach ($notifications as $n)
            <div class="flex items-start gap-3 p-4 {{ $n->read_at ? 'opacity-60' : '' }}">
                <span class="mt-1.5 w-2.5 h-2.5 rounded-full shrink-0 {{ ['danger'=>'bg-rose-500','warning'=>'bg-amber-500','success'=>'bg-emerald-500','info'=>'bg-brand-500'][$n->level] ?? 'bg-slate-400' }}"></span>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold">{{ $n->title }}</p>
                    <p class="text-sm text-slate-500">{{ $n->message }}</p>
                    <p class="text-xs text-slate-400 mt-1">{{ $n->created_at->diffForHumans() }}</p>
                </div>
                @unless ($n->read_at)
                    <form method="POST" action="{{ route('notifications.read', $n) }}">@csrf
                        <button class="text-xs text-brand-600 hover:underline">Mark read</button>
                    </form>
                @endunless
            </div>
        @endforeach
    </div>
    <div class="p-4">{{ $notifications->links() }}</div>
    @else <x-empty message="No notifications." /> @endif
</x-card>
@endsection
