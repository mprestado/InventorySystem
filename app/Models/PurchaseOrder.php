<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number', 'supplier_id', 'status', 'order_date', 'expected_date',
        'subtotal', 'tax', 'total', 'notes', 'created_by', 'approved_by',
    ];

    protected $casts = [
        'order_date' => 'date',
        'expected_date' => 'date',
    ];

    public const STATUSES = [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'ordered' => 'Ordered',
        'partially_received' => 'Partially Received',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
