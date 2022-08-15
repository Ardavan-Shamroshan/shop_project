<?php

namespace App\Models\Market;

use App\Models\City;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
