<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    protected $fillable = [
        'duration',
        'price',
        'hours',
        'start_date',
        'daily_frequency',
        'type',
        'user_id',
        'payment_id',
    ];
}
