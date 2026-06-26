<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    use HasFactory;

    protected $fillable = ['reference_no', 'type', 'reason', 'date', 'user_id', 'remarks'];

    protected $casts = ['date' => 'date'];

    public const TYPES = [
        'add' => 'Add Stock',
        'remove' => 'Remove Stock',
        'correct' => 'Correct Stock',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(AdjustmentItem::class);
    }
}
