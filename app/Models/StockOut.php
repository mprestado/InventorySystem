<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no', 'reason', 'date', 'handled_by', 'remarks'];

    protected $casts = ['date' => 'date'];

    public const REASONS = [
        'sale' => 'Sale',
        'damaged' => 'Damaged Items',
        'expired' => 'Expired Items',
        'returned_supplier' => 'Returned to Supplier',
        'internal_usage' => 'Internal Usage',
    ];

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function items()
    {
        return $this->hasMany(StockOutItem::class);
    }
}
