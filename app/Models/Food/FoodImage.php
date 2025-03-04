<?php

namespace App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use App\Models\Food;
class FoodImage extends Model
{
    use HasFactory;

    protected $table = 'food_images';

    protected $fillable = ['food_id', 'image_url'];

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
