<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutItem extends Model
{
    use HasFactory;

    protected $fillable = ['stock_out_id', 'product_variant_id', 'quantity', 'unit_cost'];

    public function stockOut()
    {
        return $this->belongsTo(StockOut::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
