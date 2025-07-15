<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BestOffer extends Model
{
    use HasFactory;

    protected $table = 'best_offers';

    protected $fillable = ['shoe_id', 'discount_percentage', 'start_date', 'end_date'];

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }
}
