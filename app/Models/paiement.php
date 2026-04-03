<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paiement extends Model
{
    protected $fillable = [
        'amount',
        'payment_method',
        'status',
        'payment_date',
        'subscription_id',
    ];

    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class);
    }
}
