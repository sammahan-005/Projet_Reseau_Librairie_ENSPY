<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'published_year',
        'genre',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'book_user', 'book_id', 'user_id')
                    ->withTimestamps();
    }
}
