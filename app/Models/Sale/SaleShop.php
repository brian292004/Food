<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleShop extends Model
{
    protected $fillable = [
        'sale_id',
        'shop_id'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}

