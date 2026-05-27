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
        'pdf_path',
        'cover_image',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'book__users')
            ->withPivot('duration')
            ->withTimestamps();
    }
}
