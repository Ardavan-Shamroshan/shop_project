<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rateable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable, Rateable;

    protected $fillable = [
        'name',
        'introduction',
        'slug',
        'image',
        'status',
        'tags',
        'weight',
        'length',
        'height',
        'width',
        'price',
        'marketable',
        'sold_number',
        'frozen_number',
        'marketable_number',
        'brand_id',
        'category_id',
        'published_at',
    ];


    protected $casts = [
        'image' => 'array'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }
    public function images()
    {
        return $this->hasMany(Gallery::class);
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class);
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function activeAmazingSales()
    {
        return $this->amazingSales()->where('start_date', '<', now())->where('end_date', '>', now())->first();
    }

    public function approvedComments() {
        return $this->comments()->where('approved', 1)->whereNull('parent_id')->get();
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
