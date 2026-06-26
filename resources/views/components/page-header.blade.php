@props(['title', 'subtitle' => null])
<div class="flex flex-wrap items-center justify-between gap-3 mb-5">
    <div class="min-w-0">
        <h1 class="text-lg font-600 tracking-tight text-slate-900 dark:text-white truncate">{{ $title }}</h1>
        @if ($subtitle)<p class="text-[13px] text-slate-500 dark:text-slate-400 mt-0.5">{{ $subtitle }}</p>@endif
    </div>
    <div class="flex items-center gap-2 shrink-0">{{ $slot }}</div>
</div>
