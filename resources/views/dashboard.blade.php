@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
@php
    $tiles = [
        ['label'=>'Total Products','value'=>number_format($stats['total_products']),'icon'=>'package','tone'=>'neutral','href'=>route('products.index')],
        ['label'=>'Categories','value'=>number_format($stats['total_categories']),'icon'=>'tags','tone'=>'neutral','href'=>route('categories.index')],
        ['label'=>'Low Stock','value'=>number_format($stats['low_stock']),'icon'=>'alert-triangle','tone'=>'amber','href'=>route('reports.show','low-stock')],
        ['label'=>'Out of Stock','value'=>number_format($stats['out_of_stock']),'icon'=>'x-circle','tone'=>'red','href'=>route('reports.show','low-stock')],
    ];
    $toneText = ['neutral'=>'text-slate-900 dark:text-white','amber'=>'text-amber-600 dark:text-amber-400','red'=>'text-rose-600 dark:text-rose-400'];
    $toneIcon = ['neutral'=>'text-slate-400','amber'=>'text-amber-500','red'=>'text-rose-500'];
@endphp

<!-- Toolbar -->
<div class="flex flex-wrap items-center justify-between gap-3 mb-5">
    <div>
        <h1 class="text-lg font-600 tracking-tight text-slate-900 dark:text-white">Overview</h1>
        <p class="text-[13px] text-slate-500 dark:text-slate-400 mt-0.5">{{ now()->format('l, M j, Y') }} · {{ $stats['today_orders'] }} sales logged today</p>
    </div>
    <div class="flex flex-wrap gap-2">
        @can('process sales')<x-btn href="{{ route('pos') }}"><i data-lucide="plus"></i> New Sale</x-btn>@endcan
        @can('manage stock_in')<x-btn href="{{ route('stock-ins.create') }}" variant="secondary"><i data-lucide="arrow-down-to-line"></i> Stock In</x-btn>@endcan
        @can('manage products')<x-btn href="{{ route('products.create') }}" variant="secondary"><i data-lucide="plus"></i> Add Item</x-btn>@endcan
    </div>
</div>

<!-- KPI tiles -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-3">
    @foreach ($tiles as $c)
        <a href="{{ $c['href'] }}" class="group bg-white dark:bg-ink-900 rounded-lg border border-slate-200 dark:border-ink-800 p-4 hover:border-slate-300 dark:hover:border-ink-700 transition-colors duration-150">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-600 uppercase tracking-wide text-slate-400">{{ $c['label'] }}</span>
                <i data-lucide="{{ $c['icon'] }}" class="w-4 h-4 {{ $toneIcon[$c['tone']] }}"></i>
            </div>
            <p class="tnum text-[28px] leading-none font-600 mt-3 {{ $toneText[$c['tone']] }}">{{ $c['value'] }}</p>
        </a>
    @endforeach
</div>

<!-- Revenue strip -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3">
    <div class="bg-white dark:bg-ink-900 rounded-lg border border-slate-200 dark:border-ink-800 px-4 py-3">
        <p class="text-[11px] font-600 uppercase tracking-wide text-slate-400">Today's Sales</p>
        <p class="tnum text-xl font-600 text-slate-900 dark:text-white mt-1">{{ money($stats['today_sales']) }}</p>
    </div>
    <div class="bg-white dark:bg-ink-900 rounded-lg border border-slate-200 dark:border-ink-800 px-4 py-3">
        <p class="text-[11px] font-600 uppercase tracking-wide text-slate-400">This Month · {{ now()->format('M Y') }}</p>
        <p class="tnum text-xl font-600 text-slate-900 dark:text-white mt-1">{{ money($stats['month_sales']) }}</p>
    </div>
    <div class="bg-white dark:bg-ink-900 rounded-lg border border-slate-200 dark:border-ink-800 px-4 py-3">
        <p class="text-[11px] font-600 uppercase tracking-wide text-slate-400">Inventory Value · at cost</p>
        <p class="tnum text-xl font-600 text-slate-900 dark:text-white mt-1">{{ money($stats['inventory_value']) }}</p>
    </div>
</div>

<!-- Charts + side panels -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
    <x-card class="lg:col-span-2" padding="p-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-[13px] font-600 text-slate-900 dark:text-white">Sales — last 14 days</h3>
            <span class="text-[11px] text-slate-400">Revenue</span>
        </div>
        <canvas id="salesChart" height="104"></canvas>
    </x-card>

    <x-card padding="p-4">
        <h3 class="text-[13px] font-600 text-slate-900 dark:text-white mb-3">Best Sellers</h3>
        <div class="-mx-1">
            @forelse ($bestSellers as $i => $b)
                <div class="flex items-center gap-2.5 px-1 py-1.5 rounded hover:bg-slate-50 dark:hover:bg-ink-800/60 transition-colors duration-150">
                    <span class="tnum w-5 text-center text-xs font-600 text-slate-400">{{ $i+1 }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="text-[13px] font-500 truncate text-slate-800 dark:text-slate-100">{{ $b->variant?->display_name ?? 'Deleted product' }}</p>
                        <p class="text-[11px] text-slate-400 tnum">{{ $b->sold }} sold</p>
                    </div>
                    <span class="tnum text-[13px] font-500 text-slate-600 dark:text-slate-300">{{ money($b->revenue) }}</span>
                </div>
            @empty
                <p class="text-[13px] text-slate-400 py-6 text-center">No sales recorded yet.</p>
            @endforelse
        </div>
    </x-card>

    <x-card class="lg:col-span-2" padding="p-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-[13px] font-600 text-slate-900 dark:text-white">Stock Movement — last 14 days</h3>
            <div class="flex items-center gap-3 text-[11px] text-slate-500">
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-sm bg-emerald-500"></span>In</span>
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-sm bg-rose-500"></span>Out</span>
            </div>
        </div>
        <canvas id="movementChart" height="104"></canvas>
    </x-card>

    <x-card padding="p-4">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-[13px] font-600 text-slate-900 dark:text-white">Low Stock Alerts</h3>
            <a href="{{ route('reports.show','low-stock') }}" class="text-[11px] text-brand-600 hover:text-brand-700">Report</a>
        </div>
        <div class="-mx-1 max-h-72 overflow-y-auto">
            @forelse ($lowStockItems as $v)
                <div class="flex items-center justify-between gap-2 px-1 py-1.5 rounded hover:bg-slate-50 dark:hover:bg-ink-800/60 transition-colors duration-150">
                    <div class="min-w-0">
                        <p class="text-[13px] font-500 truncate text-slate-800 dark:text-slate-100">{{ $v->display_name }}</p>
                        <p class="text-[11px] text-slate-400 tnum">{{ $v->sku }}</p>
                    </div>
                    @if ($v->stock_quantity <= 0)
                        <x-badge color="red" dot>Out</x-badge>
                    @else
                        <x-badge color="amber" dot><span class="tnum">{{ $v->stock_quantity }}</span> left</x-badge>
                    @endif
                </div>
            @empty
                <x-empty message="Everything is in stock" icon="check-circle-2" hint="No items below their reorder level." />
            @endforelse
        </div>
    </x-card>
</div>

<!-- Recent activity -->
<x-card class="mt-3" padding="p-0">
    <div class="flex items-center justify-between px-4 py-3 border-b border-slate-200 dark:border-ink-800">
        <h3 class="text-[13px] font-600 text-slate-900 dark:text-white">Recent Stock Movements</h3>
        <a href="{{ route('activity-logs.index') }}" class="text-[11px] text-brand-600 hover:text-brand-700">View activity log</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-[13px]">
            <thead>
                <tr class="text-left text-[11px] uppercase tracking-wide text-slate-400 border-b border-slate-200 dark:border-ink-800">
                    <th class="px-4 py-2 font-600">Item</th>
                    <th class="px-4 py-2 font-600">Type</th>
                    <th class="px-4 py-2 font-600 text-right">Change</th>
                    <th class="px-4 py-2 font-600">User</th>
                    <th class="px-4 py-2 font-600 text-right">When</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-ink-800">
                @forelse ($recentActivities as $m)
                    <tr class="hover:bg-slate-50 dark:hover:bg-ink-800/40 transition-colors duration-150">
                        <td class="px-4 py-2.5 font-500 text-slate-800 dark:text-slate-100">{{ $m->variant?->display_name ?? '—' }}</td>
                        <td class="px-4 py-2.5"><x-badge color="{{ $m->direction==='in'?'green':'red' }}">{{ ucfirst(str_replace('_',' ',$m->type)) }}</x-badge></td>
                        <td class="px-4 py-2.5 text-right tnum font-600 {{ $m->direction==='in'?'text-emerald-600 dark:text-emerald-400':'text-rose-600 dark:text-rose-400' }}">{{ $m->direction==='in'?'+':'−' }}{{ $m->quantity }}</td>
                        <td class="px-4 py-2.5 text-slate-500">{{ $m->user?->name ?? 'System' }}</td>
                        <td class="px-4 py-2.5 text-right text-slate-400 whitespace-nowrap">{{ $m->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-8 text-center text-slate-400">No stock movements yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-card>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const res = await fetch('{{ route('dashboard.chart') }}', {headers:{'Accept':'application/json'}});
    const data = await res.json();
    const dark = document.documentElement.classList.contains('dark');
    const grid = dark ? 'rgba(148,163,184,.10)' : 'rgba(100,116,139,.12)';
    const tick = '#94a3b8';
    const font = { family:'Inter', size:11 };
    const opts = {
        responsive:true, maintainAspectRatio:true,
        plugins:{ legend:{display:false}, tooltip:{ backgroundColor:'#0f172a', padding:10, cornerRadius:6, titleFont:{family:'Inter',weight:'600',size:12}, bodyFont:font, bodyColor:'#cbd5e1' } },
        scales:{ y:{beginAtZero:true,border:{display:false},grid:{color:grid},ticks:{color:tick,font}}, x:{border:{display:false},grid:{display:false},ticks:{color:tick,font}} }
    };

    new Chart(document.getElementById('salesChart'), {
        type:'line',
        data:{ labels:data.labels, datasets:[{ label:'Sales', data:data.sales, borderColor:'#324c6e', backgroundColor:'rgba(50,76,110,.06)', fill:true, tension:.3, pointRadius:0, pointHoverRadius:4, pointHoverBackgroundColor:'#324c6e', borderWidth:2 }] },
        options:opts
    });
    new Chart(document.getElementById('movementChart'), {
        type:'bar',
        data:{ labels:data.labels, datasets:[
            { label:'Stock In', data:data.stock_in, backgroundColor:'#10b981', borderRadius:3, maxBarThickness:12 },
            { label:'Stock Out', data:data.stock_out, backgroundColor:'#f43f5e', borderRadius:3, maxBarThickness:12 }
        ]},
        options:opts
    });
});
</script>
@endpush
@endsection
