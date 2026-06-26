@extends('layouts.app')
@section('title', 'Reports')
@section('content')
<x-page-header title="Reports" subtitle="Generate and export business reports" />
@php
    $icons = [
        'sales'           => 'banknote',
        'inventory'       => 'boxes',
        'stock-in'        => 'arrow-down-to-line',
        'stock-out'       => 'arrow-up-from-line',
        'purchase-orders' => 'clipboard-list',
        'profit'          => 'trending-up',
        'low-stock'       => 'alert-triangle',
        'dead-stock'      => 'package-x',
        'fast-moving'     => 'zap',
    ];
@endphp
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
    @foreach ($types as $key => $label)
        <a href="{{ route('reports.show', $key) }}"
           class="group flex items-center gap-3 bg-white dark:bg-ink-900 rounded-lg border border-slate-200 dark:border-ink-800 p-4 hover:border-slate-300 dark:hover:border-ink-700 transition-colors duration-150">
            <span class="grid place-items-center w-10 h-10 shrink-0 rounded-md bg-slate-100 dark:bg-ink-800 text-slate-500 group-hover:bg-brand-50 group-hover:text-brand-600 dark:group-hover:bg-brand-900/30 transition-colors duration-150">
                <i data-lucide="{{ $icons[$key] ?? 'bar-chart-3' }}" class="w-5 h-5"></i>
            </span>
            <div class="min-w-0">
                <h3 class="text-[13px] font-600 text-slate-900 dark:text-white group-hover:text-brand-600">{{ $label }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">View &amp; export · PDF / Excel / CSV</p>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto text-slate-300 group-hover:text-slate-400 shrink-0"></i>
        </a>
    @endforeach
</div>
@endsection
