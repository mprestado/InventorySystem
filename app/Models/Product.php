<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'sku', 'barcode', 'category_id', 'brand_id', 'supplier_id',
        'unit_id', 'image', 'cost_price', 'selling_price', 'description',
        'has_variants', 'status',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'has_variants' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function defaultVariant()
    {
        return $this->hasOne(ProductVariant::class)->where('is_default', true);
    }

    public function getTotalStockAttribute(): int
    {
        return (int) $this->variants->sum('stock_quantity');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/'.$this->image);
        }

        return 'https://placehold.co/300x300/e2e8f0/64748b?text='.urlencode(substr($this->name, 0, 12));
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
