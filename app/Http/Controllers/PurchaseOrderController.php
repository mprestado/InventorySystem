<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\PurchaseOrder;
use App\Models\StockIn;
use App\Models\Supplier;
use App\Services\ActivityLogger;
use App\Services\InventoryService;
use App\Support\NumberGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $orders = PurchaseOrder::with('supplier', 'creator')->withCount('items')
            ->latest()->paginate(15);

        return view('purchase-orders.index', compact('orders'));
    }

    public function create()
    {
        return view('purchase-orders.create', [
            'suppliers' => Supplier::active()->orderBy('name')->get(),
            'variants' => $this->variants(),
            'taxRate' => (float) \App\Models\Setting::get('tax_rate', 0),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'order_date' => ['required', 'date'],
            'expected_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_variant_id' => ['required', 'exists:product_variants,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_cost' => ['required', 'numeric', 'min:0'],
        ]);

        $order = DB::transaction(function () use ($data, $request) {
            $subtotal = collect($data['items'])->sum(fn ($i) => $i['quantity'] * $i['unit_cost']);
            $tax = $data['tax'] ?? 0;

            $order = PurchaseOrder::create([
                'po_number' => NumberGenerator::purchaseOrder(),
                'supplier_id' => $data['supplier_id'],
                'status' => 'pending',
                'order_date' => $data['order_date'],
                'expected_date' => $data['expected_date'] ?? null,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $subtotal + $tax,
                'notes' => $data['notes'] ?? null,
                'created_by' => $request->user()->id,
            ]);

            foreach ($data['items'] as $item) {
                $order->items()->create([
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                    'unit_cost' => $item['unit_cost'],
                    'total' => $item['quantity'] * $item['unit_cost'],
                ]);
            }

            return $order;
        });

        ActivityLogger::log('purchase_order', "Created purchase order {$order->po_number}", $order);

        return redirect()->route('purchase-orders.show', $order)->with('success', 'Purchase order created.');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load('supplier', 'creator', 'approver', 'items.variant.product');

        return view('purchase-orders.show', ['order' => $purchaseOrder]);
    }

    public function updateStatus(Request $request, PurchaseOrder $purchaseOrder)
    {
        $data = $request->validate([
            'status' => ['required', 'in:'.implode(',', array_keys(PurchaseOrder::STATUSES))],
        ]);

        $purchaseOrder->status = $data['status'];
        if ($data['status'] === 'approved') {
            $purchaseOrder->approved_by = $request->user()->id;
        }
        $purchaseOrder->save();

        ActivityLogger::log('purchase_order', "PO {$purchaseOrder->po_number} marked {$data['status']}", $purchaseOrder);

        return back()->with('success', 'Purchase order status updated.');
    }

    public function receiveForm(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load('items.variant.product', 'supplier');

        return view('purchase-orders.receive', ['order' => $purchaseOrder]);
    }

    public function receive(Request $request, PurchaseOrder $purchaseOrder, InventoryService $inventory)
    {
        $data = $request->validate([
            'received' => ['required', 'array'],
            'received.*' => ['nullable', 'integer', 'min:0'],
        ]);

        DB::transaction(function () use ($data, $request, $purchaseOrder, $inventory) {
            $stockIn = StockIn::create([
                'reference_no' => NumberGenerator::stockIn(),
                'supplier_id' => $purchaseOrder->supplier_id,
                'purchase_order_id' => $purchaseOrder->id,
                'received_date' => now(),
                'received_by' => $request->user()->id,
                'total_cost' => 0,
            ]);

            $total = 0;
            foreach ($purchaseOrder->items as $item) {
                $qty = (int) ($data['received'][$item->id] ?? 0);
                if ($qty <= 0) {
                    continue;
                }
                $qty = min($qty, $item->quantity - $item->received_quantity);
                if ($qty <= 0) {
                    continue;
                }

                $item->increment('received_quantity', $qty);
                $variant = $item->variant;
                $inventory->move($variant, $qty, 'in', 'stock_in', $stockIn, $item->unit_cost,
                    "Received against PO {$purchaseOrder->po_number}");

                $lineTotal = $qty * $item->unit_cost;
                $total += $lineTotal;
                $stockIn->items()->create([
                    'product_variant_id' => $variant->id,
                    'quantity' => $qty,
                    'unit_cost' => $item->unit_cost,
                    'total' => $lineTotal,
                ]);
            }
            $stockIn->update(['total_cost' => $total]);

            // Update PO status
            $purchaseOrder->load('items');
            $allReceived = $purchaseOrder->items->every(fn ($i) => $i->received_quantity >= $i->quantity);
            $anyReceived = $purchaseOrder->items->contains(fn ($i) => $i->received_quantity > 0);
            $purchaseOrder->update([
                'status' => $allReceived ? 'completed' : ($anyReceived ? 'partially_received' : $purchaseOrder->status),
            ]);
        });

        ActivityLogger::log('purchase_order', "Received items for PO {$purchaseOrder->po_number}", $purchaseOrder);

        return redirect()->route('purchase-orders.show', $purchaseOrder)->with('success', 'Items received into inventory.');
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $po = $purchaseOrder->po_number;
        $purchaseOrder->delete();
        ActivityLogger::log('delete', "Deleted purchase order {$po}", $purchaseOrder);

        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order deleted.');
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
