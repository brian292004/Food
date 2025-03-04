<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Model;

class SaleShop extends Model
{
    protected $table = 'sale_shops';
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

