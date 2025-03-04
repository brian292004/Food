<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_name',
        'sale_description',
        'discount_percent',
        'discount_amount',
        'start_time',
        'end_time',
        'is_active'
    ];

    public function shops()
    {
        return $this->hasMany(SaleShop::class);
    }

    public function foods()
    {
        return $this->hasMany(SaleFood::class);
    }
}
