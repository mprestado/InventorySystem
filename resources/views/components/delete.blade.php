@props(['action', 'message' => 'This will permanently remove the record. This action cannot be undone.', 'title' => 'Delete item?', 'label' => 'Delete'])
<div x-data="{ open: false }" class="inline-flex">
    <button type="button" @click="open = true"
            {{ $attributes->merge(['class' => 'inline-grid place-items-center w-7 h-7 rounded-md text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors duration-150']) }}
            title="{{ $label }}">
        <i data-lucide="trash-2" class="w-[15px] h-[15px]"></i>
    </button>

    <template x-teleport="body">
        <div x-show="open" x-cloak class="fixed inset-0 z-50 grid place-items-center p-4" x-transition.opacity>
            <div class="absolute inset-0 bg-slate-900/40" @click="open = false"></div>
            <div class="relative w-full max-w-sm bg-white dark:bg-ink-900 rounded-lg border border-slate-200 dark:border-ink-800 shadow-pop animate-fade"
                 @keydown.escape.window="open = false">
                <div class="p-5">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 shrink-0 rounded-md bg-rose-50 dark:bg-rose-950/50 text-rose-600 grid place-items-center">
                            <i data-lucide="alert-triangle" class="w-[18px] h-[18px]"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-600 text-slate-900 dark:text-white">{{ $title }}</h3>
                            <p class="text-[13px] text-slate-500 dark:text-slate-400 mt-1">{{ $message }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2 px-5 py-3 border-t border-slate-200 dark:border-ink-800 bg-slate-50 dark:bg-ink-950/40 rounded-b-lg">
                    <button type="button" @click="open = false"
                            class="px-3 py-1.5 rounded-md text-[13px] font-500 text-slate-600 dark:text-slate-300 border border-slate-300 dark:border-ink-700 hover:bg-white dark:hover:bg-ink-800 transition-colors duration-150">Cancel</button>
                    <form method="POST" action="{{ $action }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-3 py-1.5 rounded-md text-[13px] font-500 text-white bg-rose-600 hover:bg-rose-700 transition-colors duration-150">{{ $label }}</button>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
