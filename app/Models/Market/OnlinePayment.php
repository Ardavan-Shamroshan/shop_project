<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlinePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'paymentable');
    }
}
