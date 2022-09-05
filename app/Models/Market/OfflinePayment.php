<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfflinePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    protected $fillable = [
        'amount',
        'user_id',
        'transaction_id',
        'pay_date',
        'status',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'paymentable');
    }
}
