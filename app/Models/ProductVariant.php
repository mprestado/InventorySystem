<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'name', 'sku', 'barcode', 'attributes',
        'cost_price', 'selling_price', 'stock_quantity', 'reorder_level',
        'is_default', 'status',
    ];

    protected $casts = [
        'attributes' => 'array',
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'is_default' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->product->name.($this->name && $this->name !== 'Default' ? ' — '.$this->name : '');
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->stock_quantity <= 0) {
            return 'out_of_stock';
        }

        if ($this->stock_quantity <= $this->reorder_level) {
            return 'low_stock';
        }

        return 'in_stock';
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock_quantity', '<=', 'reorder_level')
            ->where('stock_quantity', '>', 0);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('stock_quantity', '<=', 0);
    }
}
