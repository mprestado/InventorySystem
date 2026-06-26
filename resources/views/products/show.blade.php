@extends('layouts.app')
@section('title', 'Product Details')
@section('content')
<x-page-header title="{{ $product->name }}" subtitle="{{ $product->sku }}">
    <x-btn href="{{ route('products.labels', $product) }}" variant="secondary">Print Labels</x-btn>
    <x-btn href="{{ route('products.edit', $product) }}">Edit</x-btn>
</x-page-header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <x-card>
        <img src="{{ $product->image_url }}" class="w-full aspect-square object-cover rounded-xl mb-4" alt="">
        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-slate-500">Status</dt><dd>@if($product->status==='active')<x-badge color="green">Active</x-badge>@else<x-badge>Inactive</x-badge>@endif</dd></div>
            <div class="flex justify-between"><dt class="text-slate-500">Category</dt><dd class="font-medium">{{ $product->category?->name ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-500">Brand</dt><dd class="font-medium">{{ $product->brand?->name ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-500">Supplier</dt><dd class="font-medium">{{ $product->supplier?->name ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-500">Unit</dt><dd class="font-medium">{{ $product->unit?->name ?? '—' }}</dd></div>
            <div class="flex justify-between"><dt class="text-slate-500">Total Stock</dt><dd class="font-bold">{{ $product->total_stock }}</dd></div>
        </dl>
        @if ($product->description)
            <p class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 text-sm text-slate-600 dark:text-slate-400">{{ $product->description }}</p>
        @endif
    </x-card>

    <div class="lg:col-span-2 space-y-5">
        <x-card>
            <h3 class="font-bold mb-4">Variants & Stock</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left text-slate-400 border-b border-slate-200 dark:border-slate-800">
                        <tr><th class="pb-2 font-medium">Variant</th><th class="pb-2 font-medium">SKU</th><th class="pb-2 font-medium">Cost</th><th class="pb-2 font-medium">Price</th><th class="pb-2 font-medium">Stock</th><th class="pb-2 font-medium">Barcode</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($product->variants as $v)
                            <tr>
                                <td class="py-2.5 font-medium">{{ $v->name }}</td>
                                <td class="py-2.5 text-slate-500 font-mono text-xs">{{ $v->sku }}</td>
                                <td class="py-2.5">{{ money($v->cost_price) }}</td>
                                <td class="py-2.5 font-semibold text-brand-600">{{ money($v->selling_price) }}</td>
                                <td class="py-2.5"><x-badge color="{{ $v->stock_quantity<=0?'red':($v->stock_quantity<=$v->reorder_level?'amber':'green') }}">{{ $v->stock_quantity }}</x-badge></td>
                                <td class="py-2.5"><img src="{{ route('barcode.generate', $v->barcode) }}" class="h-8" alt="{{ $v->barcode }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-card>
            <h3 class="font-bold mb-4">Inventory History Timeline</h3>
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @forelse ($movements as $m)
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <span class="w-2.5 h-2.5 rounded-full {{ $m->direction==='in'?'bg-emerald-500':'bg-rose-500' }}"></span>
                            <span class="flex-1 w-px bg-slate-200 dark:bg-slate-700"></span>
                        </div>
                        <div class="pb-3 -mt-1">
                            <p class="text-sm"><span class="font-semibold {{ $m->direction==='in'?'text-emerald-600':'text-rose-600' }}">{{ $m->direction==='in'?'+':'−' }}{{ $m->quantity }}</span>
                                {{ $m->variant?->name }} · {{ ucfirst(str_replace('_',' ',$m->type)) }}</p>
                            <p class="text-xs text-slate-400">{{ $m->note }} · {{ $m->user?->name ?? 'System' }} · {{ $m->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-6">No movement history.</p>
                @endforelse
            </div>
        </x-card>
    </div>
</div>
@endsection
