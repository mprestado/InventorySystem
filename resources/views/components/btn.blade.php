@props(['href' => null, 'variant' => 'primary', 'type' => 'button'])
@php
    $styles = [
        // primary: one solid muted blue — for the single main action per view
        'primary'   => 'bg-brand-600 hover:bg-brand-700 text-white border border-transparent',
        // secondary: neutral, bordered
        'secondary' => 'bg-white dark:bg-ink-800 border border-slate-300 dark:border-ink-700 hover:bg-slate-50 dark:hover:bg-ink-700 text-slate-700 dark:text-slate-200',
        // ghost: text only, for low-emphasis / table actions
        'ghost'     => 'bg-transparent border border-transparent hover:bg-slate-100 dark:hover:bg-ink-800 text-slate-600 dark:text-slate-300',
        // semantic
        'danger'    => 'bg-rose-600 hover:bg-rose-700 text-white border border-transparent',
        'success'   => 'bg-emerald-600 hover:bg-emerald-700 text-white border border-transparent',
    ][$variant];
    $base = "inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-md text-[13px] font-500 transition-colors duration-150 active:translate-y-px focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500/40 focus-visible:ring-offset-1 dark:focus-visible:ring-offset-ink-900 disabled:opacity-50 disabled:pointer-events-none [&_svg]:w-4 [&_svg]:h-4 [&_[data-lucide]]:w-4 [&_[data-lucide]]:h-4 $styles";
@endphp
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $base]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $base]) }}>{{ $slot }}</button>
@endif
