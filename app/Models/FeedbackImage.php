<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackImage extends Model
{
    protected $fillable = [
        'feedback_id',
        'image_url'
    ];
    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }
}