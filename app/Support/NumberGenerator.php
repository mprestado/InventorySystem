<?php

namespace App\Support;

use App\Models\Adjustment;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Sale;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Support\Str;

class NumberGenerator
{
    public static function sku(string $prefix = 'PRD'): string
    {
        do {
            $sku = $prefix.'-'.strtoupper(Str::random(6));
        } while (Product::where('sku', $sku)->exists());

        return $sku;
    }

    public static function variantSku(string $base, string $variant): string
    {
        return $base.'-'.strtoupper(Str::slug($variant, ''));
    }

    public static function barcode(): string
    {
        return (string) random_int(1000000000000, 9999999999999);
    }

    protected static function sequential(string $model, string $column, string $prefix): string
    {
        $count = $model::whereYear('created_at', now()->year)->count() + 1;

        return sprintf('%s-%s-%04d', $prefix, now()->format('ym'), $count);
    }

    public static function purchaseOrder(): string
    {
        return self::sequential(PurchaseOrder::class, 'po_number', 'PO');
    }

    public static function stockIn(): string
    {
        return self::sequential(StockIn::class, 'reference_no', 'SI');
    }

    public static function stockOut(): string
    {
        return self::sequential(StockOut::class, 'reference_no', 'SO');
    }

    public static function adjustment(): string
    {
        return self::sequential(Adjustment::class, 'reference_no', 'ADJ');
    }

    public static function invoice(): string
    {
        return self::sequential(Sale::class, 'invoice_number', 'INV');
    }
}
