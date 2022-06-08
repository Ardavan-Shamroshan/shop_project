<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model {
    use HasFactory, SoftDeletes;

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'subject',
        'message'
    ];
}
