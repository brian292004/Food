<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleFood extends Model
{
    protected $fillable = [
        'sale_id',
        'food_id'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}

