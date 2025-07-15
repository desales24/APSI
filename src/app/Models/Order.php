<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_phone',
        'status',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    protected static function booted(): void
    {
        // Hitung total saat menyimpan
        static::saving(function (Order $order) {
            $order->loadMissing('items', 'items.shoe.bestOffer');

            $order->total = $order->items->sum(function ($item) {
                $discount = $item->shoe->bestOffer?->discount_percentage ?? 0;
                return $item->quantity * $item->price * (1 - $discount / 100);
            });
        });
    }
}
