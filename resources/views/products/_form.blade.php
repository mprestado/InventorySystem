@php
    $isEdit = isset($product);
    $variantsJson = $isEdit
        ? $product->variants->map(fn($v) => ['id'=>$v->id,'name'=>$v->name,'cost_price'=>(float)$v->cost_price,'selling_price'=>(float)$v->selling_price,'stock_quantity'=>$v->stock_quantity,'reorder_level'=>$v->reorder_level])->values()
        : collect();
@endphp
<form method="POST" action="{{ $action }}" enctype="multipart/form-data"
      x-data="productForm({{ $variantsJson->toJson() }}, {{ $isEdit && $product->has_variants ? 'true' : 'false' }})">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="lg:col-span-2 space-y-5">
            <x-card>
                <h3 class="font-bold mb-4">Product Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-field class="sm:col-span-2" label="Product Name" name="name" :value="$product->name ?? ''" required placeholder="e.g. Plastic Storage Box" />
                    <x-field label="Category" name="category_id" type="select">
                        <option value="">— Select —</option>
                        @foreach ($categories as $c)<option value="{{ $c->id }}" @selected(old('category_id', $product->category_id ?? '')==$c->id)>{{ $c->name }}</option>@endforeach
                    </x-field>
                    <x-field label="Brand" name="brand_id" type="select">
                        <option value="">— Select —</option>
                        @foreach ($brands as $b)<option value="{{ $b->id }}" @selected(old('brand_id', $product->brand_id ?? '')==$b->id)>{{ $b->name }}</option>@endforeach
                    </x-field>
                    <x-field label="Supplier" name="supplier_id" type="select">
                        <option value="">— Select —</option>
                        @foreach ($suppliers as $s)<option value="{{ $s->id }}" @selected(old('supplier_id', $product->supplier_id ?? '')==$s->id)>{{ $s->name }}</option>@endforeach
                    </x-field>
                    <x-field label="Unit" name="unit_id" type="select">
                        <option value="">— Select —</option>
                        @foreach ($units as $u)<option value="{{ $u->id }}" @selected(old('unit_id', $product->unit_id ?? '')==$u->id)>{{ $u->name }} ({{ $u->abbreviation }})</option>@endforeach
                    </x-field>
                    <x-field class="sm:col-span-2" label="Barcode (leave blank to auto-generate)" name="barcode" :value="$product->barcode ?? ''" placeholder="Auto-generated if empty" />
                    <x-field class="sm:col-span-2" label="Description" name="description" type="textarea" :value="$product->description ?? ''" />
                </div>
            </x-card>

            <x-card>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold">Pricing & Variants</h3>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="has_variants" value="1" x-model="hasVariants" class="rounded text-brand-600">
                        This product has variants
                    </label>
                </div>

                <!-- Simple pricing (no variants) -->
                <div x-show="!hasVariants" class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <x-field label="Cost Price" name="cost_price" type="number" :value="$product->cost_price ?? 0" />
                    <x-field label="Selling Price" name="selling_price" type="number" :value="$product->selling_price ?? 0" />
                    @unless ($isEdit)
                        <x-field label="Initial Stock" name="default_stock" type="number" value="0" />
                        <x-field label="Reorder Level" name="default_reorder" type="number" value="10" />
                    @endunless
                </div>

                <!-- Variant table -->
                <div x-show="hasVariants" x-cloak>
                    <div class="space-y-3">
                        <template x-for="(v, i) in variants" :key="i">
                            <div class="grid grid-cols-12 gap-2 items-end p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                                <input type="hidden" :name="`variants[${i}][id]`" :value="v.id">
                                <div class="col-span-12 sm:col-span-3">
                                    <label class="text-xs text-slate-500">Variant</label>
                                    <input :name="`variants[${i}][name]`" x-model="v.name" placeholder="e.g. Small"
                                           class="w-full px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none focus:border-brand-500">
                                </div>
                                <div class="col-span-6 sm:col-span-2">
                                    <label class="text-xs text-slate-500">Cost</label>
                                    <input type="number" step="0.01" :name="`variants[${i}][cost_price]`" x-model="v.cost_price" class="w-full px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none">
                                </div>
                                <div class="col-span-6 sm:col-span-2">
                                    <label class="text-xs text-slate-500">Price</label>
                                    <input type="number" step="0.01" :name="`variants[${i}][selling_price]`" x-model="v.selling_price" class="w-full px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none">
                                </div>
                                <div class="col-span-5 sm:col-span-2">
                                    <label class="text-xs text-slate-500">Stock</label>
                                    <input type="number" :name="`variants[${i}][stock_quantity]`" x-model="v.stock_quantity" class="w-full px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none">
                                </div>
                                <div class="col-span-5 sm:col-span-2">
                                    <label class="text-xs text-slate-500">Reorder</label>
                                    <input type="number" :name="`variants[${i}][reorder_level]`" x-model="v.reorder_level" class="w-full px-2.5 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none">
                                </div>
                                <div class="col-span-2 sm:col-span-1 flex justify-end">
                                    <button type="button" @click="variants.splice(i,1)" class="p-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="variants.push({id:'',name:'',cost_price:0,selling_price:0,stock_quantity:0,reorder_level:10})"
                            class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-brand-600 hover:text-brand-700">
                        ＋ Add Variant
                    </button>
                </div>
            </x-card>
        </div>

        <div class="space-y-5">
            <x-card>
                <h3 class="font-bold mb-4">Image</h3>
                <div x-data="{ preview: '{{ $isEdit && $product->image ? $product->image_url : '' }}' }">
                    <label class="block aspect-square rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-700 overflow-hidden cursor-pointer hover:border-brand-500 transition relative">
                        <template x-if="preview"><img :src="preview" class="w-full h-full object-cover"></template>
                        <template x-if="!preview">
                            <div class="absolute inset-0 grid place-items-center text-slate-400 text-sm text-center p-4">
                                <span>Click to upload<br>product image</span>
                            </div>
                        </template>
                        <input type="file" name="image" accept="image/*" class="hidden" @change="preview = URL.createObjectURL($event.target.files[0])">
                    </label>
                </div>
            </x-card>
            <x-card>
                <h3 class="font-bold mb-4">Status</h3>
                <x-field name="status" type="select">
                    <option value="active" @selected(old('status', $product->status ?? 'active')=='active')>Active</option>
                    <option value="inactive" @selected(old('status', $product->status ?? '')=='inactive')>Inactive</option>
                </x-field>
            </x-card>
            <div class="flex flex-col gap-2">
                <x-btn type="submit">{{ $isEdit ? 'Update Product' : 'Create Product' }}</x-btn>
                <x-btn href="{{ route('products.index') }}" variant="secondary">Cancel</x-btn>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function productForm(initialVariants, hasVariants) {
    return {
        hasVariants: hasVariants,
        variants: initialVariants.length ? initialVariants : [{id:'',name:'',cost_price:0,selling_price:0,stock_quantity:0,reorder_level:10}],
    }
}
</script>
@endpush
