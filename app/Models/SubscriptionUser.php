<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionUser extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'remaining',
        'start',
        'end',
    ];


    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'remaining' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
