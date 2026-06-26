<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
    protected $fillable = ['type', 'title', 'message', 'level', 'url', 'read_at'];

    protected $casts = ['read_at' => 'datetime'];

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
