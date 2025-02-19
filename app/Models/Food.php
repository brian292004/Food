<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'food_name',
        'food_description',
        'food_price',
        'food_image',
        'food_is_featured',
        'food_sold_count',
        'food_total_feedbacks',
        'food_average_rating',
        'shop_id',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}