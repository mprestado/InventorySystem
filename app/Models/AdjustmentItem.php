<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'adjustment_id', 'product_variant_id', 'quantity_before',
        'quantity_after', 'difference',
    ];

    public function adjustment()
    {
        return $this->belongsTo(Adjustment::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
