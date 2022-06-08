<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model {
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'summary',
        'body',
        'slug',
        'status',
        'image',
    ];
    protected $casts = [
        'image' => 'array'
    ];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
