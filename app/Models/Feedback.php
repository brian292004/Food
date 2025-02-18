<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'likes'
    ];
    public function images()
    {
        return $this->hasMany(FeedbackImage::class, 'feedback_id');
    }
}
