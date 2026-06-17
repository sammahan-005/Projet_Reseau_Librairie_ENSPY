<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    protected $fillable = [
        'duration',
        'price',
        'type',//'standard', 'medium', 'Premium'
        'user_id',
    ];

  
    public function paiement()
    {
        return $this->hasOne(paiement::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'subcription__users')
            ->withPivot('remaining', 'start', 'end')
            ->withTimestamps();
    }
}
