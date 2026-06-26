@php $withCost = $withCost ?? false; @endphp
<div>
    <!-- Search to add -->
    <div class="relative mb-4" x-data="{ q:'', open:false }" @click.outside="open=false">
        <input x-model="q" @focus="open=true" @input="open=true" placeholder="Search product by name or SKU to add…"
               class="w-full px-3.5 py-2.5 text-sm rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none focus:border-brand-500">
        <div x-show="open" x-cloak class="absolute z-20 mt-1 w-full max-h-64 overflow-y-auto bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-xl">
            <template x-for="v in catalog.filter(c => (c.label+c.sku).toLowerCase().includes(q.toLowerCase())).slice(0,25)" :key="v.id">
                <button type="button" @click="addItem(v); open=false; q=''"
                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 flex justify-between items-center">
                    <span><span x-text="v.label" class="font-medium"></span> <span class="text-xs text-slate-400" x-text="v.sku"></span></span>
                    <span class="text-xs text-slate-400">stock: <span x-text="v.stock"></span></span>
                </button>
            </template>
            <p class="px-4 py-3 text-sm text-slate-400" x-show="catalog.filter(c => (c.label+c.sku).toLowerCase().includes(q.toLowerCase())).length===0">No match</p>
        </div>
    </div>

    <!-- Items -->
    <div class="space-y-2">
        <template x-for="(item, i) in items" :key="i">
            <div class="grid grid-cols-12 gap-2 items-center p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                <input type="hidden" :name="`items[${i}][product_variant_id]`" :value="item.id">
                <div class="col-span-12 sm:col-span-5">
                    <p class="text-sm font-medium" x-text="item.label"></p>
                    <p class="text-xs text-slate-400" x-text="item.sku"></p>
                </div>
                <div class="col-span-5 sm:col-span-3">
                    <label class="text-xs text-slate-500">Qty</label>
                    <input type="number" min="1" :name="`items[${i}][quantity]`" x-model.number="item.quantity"
                           class="w-full px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none">
                </div>
                @if ($withCost)
                <div class="col-span-5 sm:col-span-3">
                    <label class="text-xs text-slate-500">Unit Cost</label>
                    <input type="number" step="0.01" min="0" :name="`items[${i}][unit_cost]`" x-model.number="item.unit_cost"
                           class="w-full px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none">
                </div>
                @endif
                <div class="col-span-2 sm:col-span-1 flex justify-end pt-4">
                    <button type="button" @click="items.splice(i,1)" class="p-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </template>
        <p x-show="items.length===0" class="text-sm text-slate-400 text-center py-8">No items added yet. Search above to add products.</p>
    </div>
</div>

@push('scripts')
<script>
function lineItems(catalog) {
    return {
        catalog: catalog,
        items: [],
        addItem(v) {
            if (this.items.find(i => i.id === v.id)) return;
            this.items.push({ id: v.id, label: v.label, sku: v.sku, quantity: 1, unit_cost: v.cost ?? 0, price: v.price ?? 0, stock: v.stock });
        },
        get total() {
            return this.items.reduce((s, i) => s + (i.quantity || 0) * (i.unit_cost ?? i.price ?? 0), 0);
        },
        formatMoney(n) { return '{{ setting('currency','₱') }}' + Number(n).toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}); }
    }
}
</script>
@endpush
