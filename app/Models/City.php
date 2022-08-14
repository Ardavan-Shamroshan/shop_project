<?php

namespace App\Models;

use App\Models\Market\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, SoftDeletes;

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
