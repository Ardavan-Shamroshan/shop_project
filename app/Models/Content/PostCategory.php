<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class PostCategory extends Model {
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'status',
        'tags'
    ];
    protected $casts = [
        'image' => 'array'
    ];

    public function sluggable() : array {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function posts() {
        return $this->hasMany(Post::class, 'category_id');
    }
}
