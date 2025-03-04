<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sale\SaleFood; // Import đúng class SaleFood
use App\Models\Food\FoodImage; // Import đúng class FoodImage

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
        'food_hint',
        'shop_id',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function saleFood()
    {
        return $this->hasOne(SaleFood::class, 'food_id');
    }

    public function foodImages()
    {
        return $this->hasMany(FoodImage::class, 'food_id');
    }
}