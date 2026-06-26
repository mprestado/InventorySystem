<?php

namespace App\Services;

use App\Models\AppNotification;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InventoryService
{
    /**
     * Apply a stock movement to a variant and record it in the ledger.
     *
     * @param  string  $direction  'in' or 'out'
     */
    public function move(
        ProductVariant $variant,
        int $quantity,
        string $direction,
        string $type,
        ?Model $source = null,
        float $unitCost = 0,
        ?string $note = null
    ): StockMovement {
        $quantity = abs($quantity);
        $before = $variant->stock_quantity;
        $after = $direction === 'in' ? $before + $quantity : $before - $quantity;

        $variant->stock_quantity = $after;
        $variant->save();

        $movement = new StockMovement([
            'product_variant_id' => $variant->id,
            'type' => $type,
            'direction' => $direction,
            'quantity' => $quantity,
            'quantity_before' => $before,
            'quantity_after' => $after,
            'unit_cost' => $unitCost,
            'user_id' => Auth::id(),
            'note' => $note,
        ]);

        if ($source) {
            $movement->source()->associate($source);
        }

        $movement->save();

        $this->checkStockAlerts($variant);

        return $movement;
    }

    /**
     * Directly set a variant's stock to a target value (used for corrections).
     */
    public function setStock(
        ProductVariant $variant,
        int $target,
        string $type = 'adjustment',
        ?Model $source = null,
        ?string $note = null
    ): StockMovement {
        $before = $variant->stock_quantity;
        $diff = $target - $before;

        return $this->move(
            $variant,
            abs($diff),
            $diff >= 0 ? 'in' : 'out',
            $type,
            $source,
            $variant->cost_price,
            $note
        );
    }

    protected function checkStockAlerts(ProductVariant $variant): void
    {
        $variant->loadMissing('product');
        $name = $variant->display_name;

        if ($variant->stock_quantity <= 0) {
            $this->notifyOnce('out_of_stock', $variant->id,
                'Out of Stock', "$name is out of stock.", 'danger',
                route('variants.lookup').'?id='.$variant->id);
        } elseif ($variant->stock_quantity <= $variant->reorder_level) {
            $this->notifyOnce('low_stock', $variant->id,
                'Low Stock Alert', "$name is running low ({$variant->stock_quantity} left).", 'warning',
                route('variants.lookup').'?id='.$variant->id);
        }
    }

    protected function notifyOnce(string $type, int $variantId, string $title, string $message, string $level, ?string $url): void
    {
        $exists = AppNotification::where('type', $type)
            ->where('message', $message)
            ->whereNull('read_at')
            ->exists();

        if (! $exists) {
            AppNotification::create(compact('type', 'title', 'message', 'level', 'url'));
        }
    }
}
