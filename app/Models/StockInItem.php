<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInItem extends Model
{
    use HasFactory;

    protected $fillable = ['stock_in_id', 'product_variant_id', 'quantity', 'unit_cost', 'total'];

    public function stockIn()
    {
        return $this->belongsTo(StockIn::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
