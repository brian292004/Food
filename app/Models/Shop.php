<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'shop_name',
        'shop_address',
        'shop_phone',
        'shop_email',
        'shop_logo',
        'shop_status',
    ];
}
