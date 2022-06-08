<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'persian_name',
        'original_name',
        'logo',
        'slug',
        'status',
        'tags',
    ];


    protected $casts = [
        'logo' => 'array'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'persian_name',
            ],
        ];
    }

    public function brands()
    {
        return $this->hasMany(Product::class);
    }
}
