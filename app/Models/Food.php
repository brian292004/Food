<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'food_name',
        'food_price',
        'food_description',
        'food_image',
        'food_rating',
        'shop_id',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
