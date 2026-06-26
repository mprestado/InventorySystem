@props(['label' => null, 'name', 'type' => 'text', 'value' => null, 'required' => false, 'options' => null, 'placeholder' => null, 'rows' => 3])
@php $err = $errors->has($name); @endphp
<div {{ $attributes->only('class') }}>
    @if ($label)
        <label for="{{ $name }}" class="block text-[13px] font-500 text-slate-700 dark:text-slate-300 mb-1">
            {{ $label }} @if ($required)<span class="text-rose-500">*</span>@endif
        </label>
    @endif
    @php $cls = 'w-full px-3 py-2 text-[13px] rounded-md bg-white dark:bg-ink-800 text-slate-900 dark:text-slate-100 placeholder:text-slate-400 border outline-none transition-colors duration-150 focus:ring-2 '.($err ? 'border-rose-400 focus:ring-rose-500/30' : 'border-slate-300 dark:border-ink-700 focus:border-brand-500 focus:ring-brand-500/25'); @endphp
    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}" class="{{ $cls }}">{{ old($name, $value) }}</textarea>
    @elseif ($type === 'select')
        <select name="{{ $name }}" id="{{ $name }}" class="{{ $cls }}">
            {{ $slot }}
        </select>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
               placeholder="{{ $placeholder }}" @if($type==='number') step="0.01" @endif
               class="{{ $cls }}">
    @endif
    @error($name)<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>@enderror
</div>
