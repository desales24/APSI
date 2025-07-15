<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = ['order_id', 'payment_method', 'status', 'paid_at', 'proof_of_payment'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
