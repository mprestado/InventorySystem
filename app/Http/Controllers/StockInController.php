<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\StockIn;
use App\Models\Supplier;
use App\Services\ActivityLogger;
use App\Services\InventoryService;
use App\Support\NumberGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with('supplier', 'receiver')->withCount('items')
            ->latest()->paginate(15);

        return view('stock-ins.index', compact('stockIns'));
    }

    public function create()
    {
        return view('stock-ins.create', [
            'suppliers' => Supplier::active()->orderBy('name')->get(),
            'variants' => $this->variants(),
        ]);
    }

    public function store(Request $request, InventoryService $inventory)
    {
        $data = $request->validate([
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'invoice_number' => ['nullable', 'string', 'max:100'],
            'received_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_variant_id' => ['required', 'exists:product_variants,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_cost' => ['required', 'numeric', 'min:0'],
        ]);

        $stockIn = DB::transaction(function () use ($data, $request, $inventory) {
            $total = 0;
            $stockIn = StockIn::create([
                'reference_no' => NumberGenerator::stockIn(),
                'supplier_id' => $data['supplier_id'] ?? null,
                'invoice_number' => $data['invoice_number'] ?? null,
                'received_date' => $data['received_date'],
                'received_by' => $request->user()->id,
                'notes' => $data['notes'] ?? null,
                'total_cost' => 0,
            ]);

            foreach ($data['items'] as $item) {
                $lineTotal = $item['quantity'] * $item['unit_cost'];
                $total += $lineTotal;
                $stockIn->items()->create([
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                    'unit_cost' => $item['unit_cost'],
                    'total' => $lineTotal,
                ]);
                $variant = ProductVariant::find($item['product_variant_id']);
                $inventory->move($variant, $item['quantity'], 'in', 'stock_in', $stockIn, $item['unit_cost'],
                    "Stock In {$stockIn->reference_no}");
            }

            $stockIn->update(['total_cost' => $total]);

            return $stockIn;
        });

        ActivityLogger::log('stock_in', "Recorded stock in {$stockIn->reference_no}", $stockIn);

        return redirect()->route('stock-ins.show', $stockIn)->with('success', 'Stock received successfully.');
    }

    public function show(StockIn $stockIn)
    {
        $stockIn->load('supplier', 'receiver', 'items.variant.product');

        return view('stock-ins.show', compact('stockIn'));
    }

    public function destroy(StockIn $stockIn)
    {
        $ref = $stockIn->reference_no;
        $stockIn->delete();
        ActivityLogger::log('delete', "Deleted stock in {$ref}", $stockIn);

        return redirect()->route('stock-ins.index')->with('success', 'Stock-in record deleted.');
    }

    private function variants()
    {
        return ProductVariant::with('product')->whereHas('product', fn ($q) => $q->where('status', 'active'))
            ->get()->map(fn ($v) => [
                'id' => $v->id,
                'label' => $v->display_name,
                'sku' => $v->sku,
                'cost' => (float) $v->cost_price,
                'stock' => $v->stock_quantity,
            ]);
    }
}
