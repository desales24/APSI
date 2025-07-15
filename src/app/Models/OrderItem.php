<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'shoe_id',
        'quantity',
        'price',
    ];

    public function shoe()
    {
        return $this->belongsTo(\App\Models\Shoe::class);
    }

    protected static function booted(): void
    {
        static::created(function (OrderItem $item) {
            if ($item->shoe && $item->quantity > 0) {
                $item->shoe->decrement('stock', $item->quantity);
            }
        });
    }
}
