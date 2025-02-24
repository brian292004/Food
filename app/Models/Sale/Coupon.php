<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon_code',
        'coupon_description',
        'discount_percent',
        'discount_amount',
        'usage_limit',
        'start_time',
        'end_time',
        'is_active'
    ];

    public function users()
    {
        return $this->hasMany(UserCoupon::class);
    }
}
