<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shoe extends Model
{
    use HasFactory;

    protected $table = 'shoes';

    protected $fillable = ['name', 'category_id', 'price', 'stock', 'image_url', 'description'];

    public function category()
    {
        return $this->belongsTo(CategoryShoe::class, 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // relasi ke best offer
    public function bestOffer()
    {
        return $this->hasOne(BestOffer::class)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }
}
