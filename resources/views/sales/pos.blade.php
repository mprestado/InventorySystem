@extends('layouts.app')
@section('title', 'Point of Sale')
@section('content')
<div x-data="pos({{ $variants->toJson() }}, {{ $taxRate }})" class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <!-- Catalog -->
    <div class="lg:col-span-2">
        <x-card padding="p-4" class="mb-4">
            <div class="flex gap-2">
                <input x-model="search" placeholder="Search or scan barcode…" x-ref="searchBox" @keydown.enter.prevent="scanEnter()"
                       class="flex-1 px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
                <select x-model="category" class="px-3 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
                    <option value="">All</option>
                    <template x-for="c in categories" :key="c"><option :value="c" x-text="c"></option></template>
                </select>
            </div>
        </x-card>
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-3 max-h-[calc(100vh-15rem)] overflow-y-auto pr-1">
            <template x-for="v in filtered" :key="v.id">
                <button type="button" @click="addToCart(v)" :disabled="v.stock<=0"
                        class="text-left bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg hover:border-brand-400 transition disabled:opacity-40 disabled:cursor-not-allowed">
                    <div class="aspect-square bg-slate-100 dark:bg-slate-800"><img :src="v.image" class="w-full h-full object-cover"></div>
                    <div class="p-2.5">
                        <p class="text-sm font-semibold leading-tight line-clamp-2" x-text="v.label"></p>
                        <div class="flex justify-between items-center mt-1">
                            <span class="font-bold text-brand-600" x-text="formatMoney(v.price)"></span>
                            <span class="text-[11px] text-slate-400" x-text="v.stock + ' left'"></span>
                        </div>
                    </div>
                </button>
            </template>
        </div>
    </div>

    <!-- Cart -->
    <div>
        <x-card padding="p-0" class="sticky top-20 flex flex-col max-h-[calc(100vh-6rem)]">
            <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="font-bold">Current Sale</h3>
                <button type="button" @click="cart=[]" class="text-xs text-rose-500 hover:underline" x-show="cart.length">Clear</button>
            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-2 min-h-[120px]">
                <template x-for="(item, i) in cart" :key="item.id">
                    <div class="flex items-center gap-2">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate" x-text="item.label"></p>
                            <p class="text-xs text-slate-400" x-text="formatMoney(item.price)"></p>
                        </div>
                        <div class="flex items-center gap-1">
                            <button type="button" @click="item.qty=Math.max(1,item.qty-1)" class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 font-bold">−</button>
                            <input type="number" x-model.number="item.qty" min="1" :max="item.stock" class="w-12 text-center px-1 py-1 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900">
                            <button type="button" @click="item.qty=Math.min(item.stock,item.qty+1)" class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 font-bold">＋</button>
                        </div>
                        <span class="w-20 text-right text-sm font-semibold" x-text="formatMoney(item.qty*item.price)"></span>
                        <button type="button" @click="cart.splice(i,1)" class="text-rose-400 hover:text-rose-600">✕</button>
                    </div>
                </template>
                <p x-show="cart.length===0" class="text-sm text-slate-400 text-center py-10">Tap a product to add it to the sale.</p>
            </div>
            <div class="p-4 border-t border-slate-200 dark:border-slate-800 space-y-3">
                <select x-model="customer_id" class="w-full px-3 py-2 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
                    <option value="">Walk-in Customer</option>
                    @foreach ($customers as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach
                </select>
                <div class="grid grid-cols-2 gap-2">
                    <label class="text-xs text-slate-500">Discount
                        <input type="number" x-model.number="discount" min="0" class="w-full mt-1 px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900">
                    </label>
                    <label class="text-xs text-slate-500">Payment
                        <select x-model="payment_method" class="w-full mt-1 px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900">
                            <option value="cash">Cash</option><option value="card">Card</option><option value="gcash">GCash</option><option value="bank">Bank</option>
                        </select>
                    </label>
                </div>
                <div class="text-sm space-y-1">
                    <div class="flex justify-between text-slate-500"><span>Subtotal</span><span x-text="formatMoney(subtotal)"></span></div>
                    <div class="flex justify-between text-slate-500"><span>Tax ({{ $taxRate }}%)</span><span x-text="formatMoney(tax)"></span></div>
                    <div class="flex justify-between text-slate-500"><span>Discount</span><span x-text="'- '+formatMoney(discount)"></span></div>
                    <div class="flex justify-between text-lg font-extrabold pt-1"><span>Total</span><span class="text-brand-600" x-text="formatMoney(grandTotal)"></span></div>
                </div>
                <label class="block text-xs text-slate-500">Amount Paid
                    <input type="number" x-model.number="amount_paid" min="0" class="w-full mt-1 px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900">
                </label>
                <div class="flex justify-between text-sm font-semibold" x-show="amount_paid>0"><span>Change</span><span x-text="formatMoney(Math.max(0, amount_paid-grandTotal))"></span></div>
                <button type="button" @click="checkout()" :disabled="cart.length===0 || processing"
                        class="w-full py-3 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold shadow-lg shadow-brand-600/30 transition disabled:opacity-50">
                    <span x-show="!processing">Complete Sale</span><span x-show="processing">Processing…</span>
                </button>
            </div>
        </x-card>
    </div>
</div>

@push('scripts')
<script>
function pos(catalog, taxRate) {
    return {
        catalog, taxRate, search:'', category:'',
        cart:[], customer_id:'', discount:0, payment_method:'cash', amount_paid:0, processing:false,
        get categories() { return [...new Set(this.catalog.map(c => c.category))].sort(); },
        get filtered() {
            return this.catalog.filter(v =>
                (!this.category || v.category===this.category) &&
                (this.search==='' || (v.label+v.sku+v.barcode).toLowerCase().includes(this.search.toLowerCase())));
        },
        get subtotal() { return this.cart.reduce((s,i)=>s+i.qty*i.price,0); },
        get tax() { return this.subtotal * this.taxRate/100; },
        get grandTotal() { return Math.max(0, this.subtotal + this.tax - this.discount); },
        addToCart(v) {
            if (v.stock<=0) return;
            const e = this.cart.find(i=>i.id===v.id);
            if (e) { if (e.qty<v.stock) e.qty++; }
            else this.cart.push({id:v.id,label:v.label,price:v.price,qty:1,stock:v.stock});
        },
        scanEnter() {
            const hit = this.catalog.find(v => v.barcode===this.search.trim() || v.sku===this.search.trim());
            if (hit) { this.addToCart(hit); this.search=''; }
        },
        formatMoney(n) { return '{{ $currency }}' + Number(n).toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}); },
        async checkout() {
            if (!this.cart.length) return;
            this.processing = true;
            try {
                const res = await fetch('{{ route('sales.store') }}', {
                    method:'POST',
                    headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},
                    body: JSON.stringify({
                        customer_id:this.customer_id||null, payment_method:this.payment_method,
                        discount:this.discount, tax:this.tax, amount_paid:this.amount_paid||this.grandTotal,
                        items:this.cart.map(i=>({product_variant_id:i.id,quantity:i.qty,unit_price:i.price,discount:0}))
                    })
                });
                const data = await res.json();
                if (res.ok && data.success) { window.location = data.receipt_url; }
                else { alert(data.message || 'Sale failed. Check stock levels.'); this.processing=false; }
            } catch(e) { alert('Error processing sale.'); this.processing=false; }
        }
    }
}
</script>
@endpush
@endsection
