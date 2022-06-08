<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guaranty extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'guarantees';
}
