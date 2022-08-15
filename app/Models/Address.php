<?php

namespace App\Models;

use App\Models\Market\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'addresses';

    protected $guarded = ['id'];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipient(): Attribute {
        return Attribute::make(
            get: fn() => ($this->recipient_first_name !== null) ? $this->recipient_first_name . ' ' . $this->recipient_last_name : '-',
        );
    }

}
