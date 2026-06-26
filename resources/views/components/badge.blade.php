@props(['color' => 'slate', 'dot' => false])
@php
    $map = [
        'slate'  => ['bg-slate-100 text-slate-600 dark:bg-ink-800 dark:text-slate-300','bg-slate-400'],
        'green'  => ['bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-400','bg-emerald-500'],   // in stock
        'amber'  => ['bg-amber-50 text-amber-700 dark:bg-amber-950/50 dark:text-amber-400','bg-amber-500'],            // low stock
        'red'    => ['bg-rose-50 text-rose-700 dark:bg-rose-950/50 dark:text-rose-400','bg-rose-500'],                 // out of stock
        'blue'   => ['bg-brand-50 text-brand-700 dark:bg-brand-900/40 dark:text-brand-300','bg-brand-500'],
        'purple' => ['bg-slate-100 text-slate-600 dark:bg-ink-800 dark:text-slate-300','bg-slate-400'],
    ];
    [$cls, $dotCls] = $map[$color] ?? $map['slate'];
@endphp
<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-xs font-500 $cls"]) }}>
    @if ($dot)<span class="w-1.5 h-1.5 rounded-full {{ $dotCls }}"></span>@endif
    {{ $slot }}
</span>
