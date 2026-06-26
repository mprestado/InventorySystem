<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\Unit;
use App\Services\ActivityLogger;
use App\Support\NumberGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'variants'])->latest();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('sku', 'like', "%$search%")
                    ->orWhere('barcode', 'like', "%$search%");
            });
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::active()->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    public function create()
    {
        return view('products.create', $this->formData());
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        DB::transaction(function () use ($request, $data) {
            $base = NumberGenerator::sku();
            $product = Product::create([
                'name' => $data['name'],
                'sku' => $base,
                'barcode' => $data['barcode'] ?: NumberGenerator::barcode(),
                'category_id' => $data['category_id'] ?? null,
                'brand_id' => $data['brand_id'] ?? null,
                'supplier_id' => $data['supplier_id'] ?? null,
                'unit_id' => $data['unit_id'] ?? null,
                'cost_price' => $data['cost_price'] ?? 0,
                'selling_price' => $data['selling_price'] ?? 0,
                'description' => $data['description'] ?? null,
                'has_variants' => $request->boolean('has_variants'),
                'status' => $data['status'],
                'image' => $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null,
            ]);

            $this->syncVariants($product, $request, $base, true);

            ActivityLogger::log('create', "Created product: {$product->name}", $product);
        });

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'supplier', 'unit', 'variants']);
        $movements = StockMovement::whereIn('product_variant_id', $product->variants->pluck('id'))
            ->with(['variant', 'user'])->latest()->limit(30)->get();

        return view('products.show', compact('product', 'movements'));
    }

    public function edit(Product $product)
    {
        $product->load('variants');

        return view('products.edit', array_merge($this->formData(), compact('product')));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request, $product);

        DB::transaction(function () use ($request, $data, $product) {
            $product->fill([
                'name' => $data['name'],
                'barcode' => $data['barcode'] ?: $product->barcode,
                'category_id' => $data['category_id'] ?? null,
                'brand_id' => $data['brand_id'] ?? null,
                'supplier_id' => $data['supplier_id'] ?? null,
                'unit_id' => $data['unit_id'] ?? null,
                'cost_price' => $data['cost_price'] ?? 0,
                'selling_price' => $data['selling_price'] ?? 0,
                'description' => $data['description'] ?? null,
                'has_variants' => $request->boolean('has_variants'),
                'status' => $data['status'],
            ]);
            if ($request->hasFile('image')) {
                $product->image = $request->file('image')->store('products', 'public');
            }
            $product->save();

            $this->syncVariants($product, $request, $product->sku, false);

            ActivityLogger::log('update', "Updated product: {$product->name}", $product);
        });

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();
        ActivityLogger::log('delete', "Deleted product: {$name}", $product);

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }

    public function labels(Product $product)
    {
        $product->load('variants');

        return view('products.labels', compact('product'));
    }

    private function formData(): array
    {
        return [
            'categories' => Category::active()->orderBy('name')->get(),
            'brands' => Brand::active()->orderBy('name')->get(),
            'suppliers' => Supplier::active()->orderBy('name')->get(),
            'units' => Unit::orderBy('name')->get(),
        ];
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'barcode' => ['nullable', 'string', 'max:100'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'unit_id' => ['nullable', 'exists:units,id'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
            'selling_price' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'image' => ['nullable', 'image', 'max:4096'],
            'variants' => ['nullable', 'array'],
            'variants.*.name' => ['nullable', 'string', 'max:255'],
            'variants.*.cost_price' => ['nullable', 'numeric', 'min:0'],
            'variants.*.selling_price' => ['nullable', 'numeric', 'min:0'],
            'variants.*.stock_quantity' => ['nullable', 'integer', 'min:0'],
            'variants.*.reorder_level' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function syncVariants(Product $product, Request $request, string $baseSku, bool $isNew): void
    {
        $variants = collect($request->input('variants', []))
            ->filter(fn ($v) => filled($v['name'] ?? null) || ! $request->boolean('has_variants'));

        if ($variants->isEmpty()) {
            // Single, default variant mirrors the product
            $variants = collect([[
                'name' => 'Default',
                'cost_price' => $request->input('cost_price', 0),
                'selling_price' => $request->input('selling_price', 0),
                'stock_quantity' => $request->input('default_stock', 0),
                'reorder_level' => $request->input('default_reorder', 10),
            ]]);
        }

        $keptIds = [];
        foreach ($variants as $i => $v) {
            $name = $v['name'] ?: 'Default';
            $id = $v['id'] ?? null;
            $stock = (int) ($v['stock_quantity'] ?? 0);

            if ($id && $variant = $product->variants()->find($id)) {
                $oldStock = $variant->stock_quantity;
                $variant->update([
                    'name' => $name,
                    'cost_price' => $v['cost_price'] ?? 0,
                    'selling_price' => $v['selling_price'] ?? 0,
                    'reorder_level' => $v['reorder_level'] ?? 10,
                    'is_default' => $i === 0,
                ]);
                if ($stock !== $oldStock) {
                    $this->recordStock($variant, $oldStock, $stock, 'Stock corrected via product edit');
                }
            } else {
                $variant = $product->variants()->create([
                    'name' => $name,
                    'sku' => NumberGenerator::variantSku($baseSku, $name).'-'.($i + 1),
                    'barcode' => NumberGenerator::barcode(),
                    'attributes' => ['variant' => $name],
                    'cost_price' => $v['cost_price'] ?? 0,
                    'selling_price' => $v['selling_price'] ?? 0,
                    'stock_quantity' => 0,
                    'reorder_level' => $v['reorder_level'] ?? 10,
                    'is_default' => $i === 0,
                ]);
                if ($stock > 0) {
                    $this->recordStock($variant, 0, $stock, 'Initial stock');
                }
            }
            $keptIds[] = $variant->id;
        }

        // Remove variants the user deleted (only on update)
        if (! $isNew) {
            $product->variants()->whereNotIn('id', $keptIds)->delete();
        }
    }

    private function recordStock(ProductVariant $variant, int $before, int $after, string $note): void
    {
        $variant->update(['stock_quantity' => $after]);
        StockMovement::create([
            'product_variant_id' => $variant->id,
            'type' => 'adjustment',
            'direction' => $after >= $before ? 'in' : 'out',
            'quantity' => abs($after - $before),
            'quantity_before' => $before,
            'quantity_after' => $after,
            'unit_cost' => $variant->cost_price,
            'user_id' => auth()->id(),
            'note' => $note,
        ]);
    }
}
