<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    protected $fillable=[

        'user_id',
        'book_id',
        'duration',
        
    ];

    protected $casts = [
        'duration' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
