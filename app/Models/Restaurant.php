<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'support_email',
        'support_messenger',
        'description',
        'image',
        'rating'
    ];
    // Liên kết 1-N với Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
