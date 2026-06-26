<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\StockOut;
use App\Services\ActivityLogger;
use App\Services\InventoryService;
use App\Support\NumberGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with('handler')->withCount('items')->latest()->paginate(15);

        return view('stock-outs.index', compact('stockOuts'));
    }

    public function create()
    {
        return view('stock-outs.create', [
            'reasons' => StockOut::REASONS,
            'variants' => $this->variants(),
        ]);
    }

    public function store(Request $request, InventoryService $inventory)
    {
        $data = $request->validate([
            'reason' => ['required', 'in:'.implode(',', array_keys(StockOut::REASONS))],
            'date' => ['required', 'date'],
            'remarks' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_variant_id' => ['required', 'exists:product_variants,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        // Guard against negative stock
        foreach ($data['items'] as $i => $item) {
            $variant = ProductVariant::find($item['product_variant_id']);
            if ($variant->stock_quantity < $item['quantity']) {
                throw ValidationException::withMessages([
                    "items.$i.quantity" => "Only {$variant->stock_quantity} of {$variant->display_name} in stock.",
                ]);
            }
        }

        $stockOut = DB::transaction(function () use ($data, $request, $inventory) {
            $stockOut = StockOut::create([
                'reference_no' => NumberGenerator::stockOut(),
                'reason' => $data['reason'],
                'date' => $data['date'],
                'handled_by' => $request->user()->id,
                'remarks' => $data['remarks'] ?? null,
            ]);

            foreach ($data['items'] as $item) {
                $variant = ProductVariant::find($item['product_variant_id']);
                $stockOut->items()->create([
                    'product_variant_id' => $variant->id,
                    'quantity' => $item['quantity'],
                    'unit_cost' => $variant->cost_price,
                ]);
                $inventory->move($variant, $item['quantity'], 'out', 'stock_out', $stockOut, $variant->cost_price,
                    StockOut::REASONS[$data['reason']].' — '.$stockOut->reference_no);
            }

            return $stockOut;
        });

        ActivityLogger::log('stock_out', "Recorded stock out {$stockOut->reference_no}", $stockOut);

        return redirect()->route('stock-outs.show', $stockOut)->with('success', 'Stock out recorded successfully.');
    }

    public function show(StockOut $stockOut)
    {
        $stockOut->load('handler', 'items.variant.product');

        return view('stock-outs.show', compact('stockOut'));
    }

    public function destroy(StockOut $stockOut)
    {
        $ref = $stockOut->reference_no;
        $stockOut->delete();
        ActivityLogger::log('delete', "Deleted stock out {$ref}", $stockOut);

        return redirect()->route('stock-outs.index')->with('success', 'Stock-out record deleted.');
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
