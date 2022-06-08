<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model {
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'question',
        'answer',
        'status',
        'slug',
        'tags',
    ];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'question',
            ],
        ];
    }
}
