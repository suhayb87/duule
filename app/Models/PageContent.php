<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'section',
        'title',
        'content',
        'image',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}