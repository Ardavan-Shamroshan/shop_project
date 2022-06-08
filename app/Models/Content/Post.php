<?php

namespace App\Models\Content;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'summary',
        'body',
        'slug',
        'status',
        'tags',
        'image',
        'author_id',
        'category_id',
        'commentable',
        'published_at'
    ];
    protected $casts = [
        'image' => 'array'
    ];

    public function sluggable()
    : array {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function category() {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
