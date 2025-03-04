<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Food;
use App\Models\Sale\SaleShop;

class Shop extends Model
{
    protected $fillable = [
        'shop_name',
        'shop_address',
        'shop_phone',
        'shop_email',
        'shop_logo',
        'shop_status',
        'shop_support_email',
        'shop_support_messenger',
        'shop_description',
        'shop_rating',
    ];
    public function products()
    {
        return $this->hasMany(Food::class);
    }

    public function saleShop()
    {
        return $this->hasOne(SaleShop::class, 'shop_id');
    }
}