<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'duration',
        'price',
        'type',//'standard', 'medium', 'Premium'
        'user_id',
    ];

  
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'subcription__users')
            ->withPivot('remaining', 'start', 'end')
            ->withTimestamps();
    }
}
