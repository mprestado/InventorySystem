<?php

namespace App\Http\Controllers;

use App\Models\Adjustment;
use App\Models\ProductVariant;
use App\Services\ActivityLogger;
use App\Services\InventoryService;
use App\Support\NumberGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdjustmentController extends Controller
{
    public function index()
    {
        $adjustments = Adjustment::with('user')->withCount('items')->latest()->paginate(15);

        return view('adjustments.index', compact('adjustments'));
    }

    public function create()
    {
        return view('adjustments.create', [
            'types' => Adjustment::TYPES,
            'variants' => $this->variants(),
        ]);
    }

    public function store(Request $request, InventoryService $inventory)
    {
        $data = $request->validate([
            'type' => ['required', 'in:add,remove,correct'],
            'reason' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'remarks' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_variant_id' => ['required', 'exists:product_variants,id'],
            'items.*.quantity' => ['required', 'integer'],
        ]);

        $adjustment = DB::transaction(function () use ($data, $request, $inventory) {
            $adjustment = Adjustment::create([
                'reference_no' => NumberGenerator::adjustment(),
                'type' => $data['type'],
                'reason' => $data['reason'],
                'date' => $data['date'],
                'user_id' => $request->user()->id,
                'remarks' => $data['remarks'] ?? null,
            ]);

            foreach ($data['items'] as $item) {
                $variant = ProductVariant::find($item['product_variant_id']);
                $before = $variant->stock_quantity;
                $qty = (int) $item['quantity'];

                $after = match ($data['type']) {
                    'add' => $before + abs($qty),
                    'remove' => max(0, $before - abs($qty)),
                    'correct' => max(0, $qty), // quantity = target count
                };

                $inventory->setStock($variant, $after, 'adjustment', $adjustment,
                    "Adjustment ({$data['type']}): {$data['reason']}");

                $adjustment->items()->create([
                    'product_variant_id' => $variant->id,
                    'quantity_before' => $before,
                    'quantity_after' => $after,
                    'difference' => $after - $before,
                ]);
            }

            return $adjustment;
        });

        ActivityLogger::log('adjustment', "Recorded adjustment {$adjustment->reference_no}", $adjustment);

        return redirect()->route('adjustments.show', $adjustment)->with('success', 'Inventory adjusted successfully.');
    }

    public function show(Adjustment $adjustment)
    {
        $adjustment->load('user', 'items.variant.product');

        return view('adjustments.show', compact('adjustment'));
    }

    public function destroy(Adjustment $adjustment)
    {
        $ref = $adjustment->reference_no;
        $adjustment->delete();
        ActivityLogger::log('delete', "Deleted adjustment {$ref}", $adjustment);

        return redirect()->route('adjustments.index')->with('success', 'Adjustment record deleted.');
    }

    private function variants()
    {
        return ProductVariant::with('product')->whereHas('product', fn ($q) => $q->where('status', 'active'))
            ->get()->map(fn ($v) => [
                'id' => $v->id,
                'label' => $v->display_name,
                'sku' => $v->sku,
                'stock' => $v->stock_quantity,
            ]);
    }
}
