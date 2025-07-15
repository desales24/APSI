<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryShoe extends Model
{
    use HasFactory;

    protected $table = 'category_shoes';

    protected $fillable = ['name', 'description'];

    public function shoes()
    {
        return $this->hasMany(Shoe::class, 'category_id');
    }
}
