<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'url',
        'status',
        'image',
    ];

    protected $casts = ['image' => 'array'];
}
