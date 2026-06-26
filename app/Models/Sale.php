<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number', 'customer_id', 'subtotal', 'discount', 'tax',
        'total', 'payment_method', 'amount_paid', 'change_due', 'status',
        'cashier_id', 'sale_date',
    ];

    protected $casts = ['sale_date' => 'datetime'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function getProfitAttribute(): float
    {
        return $this->items->sum(fn ($i) => ($i->unit_price - $i->unit_cost) * $i->quantity - $i->discount);
    }
}
