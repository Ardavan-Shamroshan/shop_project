<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuickLink extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'title',
        'url',
        'status',
    ];
}
