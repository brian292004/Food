<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleFood extends Model
{
    use HasFactory;

    protected $table = 'sale_foods';
    protected $fillable = [
        'sale_id',
        'food_id'
    ];

    public function sale()
{
    return $this->belongsTo(Sale::class, 'sale_id');
}

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}

