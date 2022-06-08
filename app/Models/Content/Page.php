<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model {
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'body',
        'status',
        'tags',
    ];

    public function sluggable() : array {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
