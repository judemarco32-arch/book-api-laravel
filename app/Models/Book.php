<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_year',
        'is_available',
    ];

    protected $casts = [
        'published_year' => 'integer',
        'is_available'   => 'boolean',
    ];
}
