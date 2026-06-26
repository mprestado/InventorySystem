<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ProductVariant;
use App\Models\Sale;
use App\Models\Setting;
use App\Services\ActivityLogger;
use App\Services\InventoryService;
use App\Support\NumberGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function pos()
    {
        $variants = ProductVariant::with('product.category')
            ->whereHas('product', fn ($q) => $q->where('status', 'active'))
            ->where('status', 'active')
            ->get()
            ->map(fn ($v) => [
                'id' => $v->id,
                'name' => $v->product->name,
                'variant' => $v->name,
                'label' => $v->display_name,
                'sku' => $v->sku,
                'barcode' => $v->barcode,
                'price' => (float) ($v->selling_price ?: $v->product->selling_price),
                'stock' => $v->stock_quantity,
                'category' => $v->product->category?->name ?? 'Uncategorized',
                'image' => $v->product->image_url,
            ]);

        return view('sales.pos', [
            'variants' => $variants,
            'customers' => Customer::orderBy('name')->get(),
            'taxRate' => (float) Setting::get('tax_rate', 0),
            'currency' => Setting::get('currency', '₱'),
        ]);
    }

    public function index(Request $request)
    {
        $sales = Sale::with('customer', 'cashier')->withCount('items')
            ->when($request->date, fn ($q, $d) => $q->whereDate('sale_date', $d))
            ->when($request->search, fn ($q, $s) => $q->where('invoice_number', 'like', "%$s%"))
            ->latest('sale_date')->paginate(15)->withQueryString();

        return view('sales.index', compact('sales'));
    }

    public function store(Request $request, InventoryService $inventory)
    {
        $data = $request->validate([
            'customer_id' => ['nullable', 'exists:customers,id'],
            'payment_method' => ['required', 'in:cash,card,gcash,bank'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'amount_paid' => ['required', 'numeric', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_variant_id' => ['required', 'exists:product_variants,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
            'items.*.discount' => ['nullable', 'numeric', 'min:0'],
        ]);

        foreach ($data['items'] as $i => $item) {
            $variant = ProductVariant::find($item['product_variant_id']);
            if ($variant->stock_quantity < $item['quantity']) {
                throw ValidationException::withMessages([
                    'items' => "Insufficient stock for {$variant->display_name} ({$variant->stock_quantity} left).",
                ]);
            }
        }

        $sale = DB::transaction(function () use ($data, $request, $inventory) {
            $subtotal = collect($data['items'])->sum(fn ($i) => $i['quantity'] * $i['unit_price'] - ($i['discount'] ?? 0));
            $discount = $data['discount'] ?? 0;
            $tax = $data['tax'] ?? 0;
            $total = max(0, $subtotal - $discount + $tax);

            $sale = Sale::create([
                'invoice_number' => NumberGenerator::invoice(),
                'customer_id' => $data['customer_id'] ?? null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'total' => $total,
                'payment_method' => $data['payment_method'],
                'amount_paid' => $data['amount_paid'],
                'change_due' => max(0, $data['amount_paid'] - $total),
                'status' => 'completed',
                'cashier_id' => $request->user()->id,
                'sale_date' => now(),
            ]);

            foreach ($data['items'] as $item) {
                $variant = ProductVariant::find($item['product_variant_id']);
                $lineTotal = $item['quantity'] * $item['unit_price'] - ($item['discount'] ?? 0);
                $sale->items()->create([
                    'product_variant_id' => $variant->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'unit_cost' => $variant->cost_price,
                    'discount' => $item['discount'] ?? 0,
                    'total' => $lineTotal,
                ]);
                $inventory->move($variant, $item['quantity'], 'out', 'sale', $sale, $variant->cost_price,
                    "Sale {$sale->invoice_number}");
            }

            return $sale;
        });

        ActivityLogger::log('sale', "Completed sale {$sale->invoice_number} (₱".number_format($sale->total, 2).')', $sale);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'sale_id' => $sale->id,
                'receipt_url' => route('sales.receipt', $sale),
            ]);
        }

        return redirect()->route('sales.receipt', $sale);
    }

    public function show(Sale $sale)
    {
        $sale->load('customer', 'cashier', 'items.variant.product');

        return view('sales.show', compact('sale'));
    }

    public function receipt(Sale $sale)
    {
        $sale->load('customer', 'cashier', 'items.variant.product');

        return view('sales.receipt', [
            'sale' => $sale,
            'shop' => Setting::get('shop_name', 'Houseware Shop'),
            'address' => Setting::get('address', ''),
            'phone' => Setting::get('phone', ''),
            'currency' => Setting::get('currency', '₱'),
        ]);
    }
}
