<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'image',
        'is_featured',
        'sold_count',
        'total_feedbacks',
        'average_rating'
    ];

    // Liên kết N-1 với Restaurant
    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
}
