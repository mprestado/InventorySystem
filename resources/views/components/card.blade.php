@props(['padding' => 'p-4'])
{{-- Flat, bordered surface — no floating shadows. --}}
<div {{ $attributes->merge(['class' =>
    "bg-white dark:bg-ink-900 rounded-lg border border-slate-200 dark:border-ink-800 $padding"
]) }}>
    {{ $slot }}
</div>
