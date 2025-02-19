<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'pm_name',
        'pm_description',
        'pm_discount',
        'pm_start_date',
        'pm_end_date',
        'pm_status',
    ];
}
