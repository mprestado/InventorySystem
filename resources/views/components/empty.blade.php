@props(['message' => 'No items yet.', 'icon' => 'package-open', 'hint' => null])
<div class="py-14 px-6 text-center">
    <div class="mx-auto w-11 h-11 rounded-lg bg-slate-100 dark:bg-ink-800 border border-slate-200 dark:border-ink-700 grid place-items-center mb-3 text-slate-400">
        <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
    </div>
    <p class="text-sm font-500 text-slate-700 dark:text-slate-200">{{ $message }}</p>
    @if ($hint)<p class="text-[13px] text-slate-400 mt-1">{{ $hint }}</p>@endif
    @if (trim($slot) !== '')<div class="mt-4 flex justify-center">{{ $slot }}</div>@endif
</div>
