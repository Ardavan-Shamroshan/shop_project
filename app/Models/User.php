<?php

namespace App\Models;

use App\Models\Market\Order;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'national_code',
        'user_type',
        'activation',
        'status',
        'profile_photo_path',
        'email_verified_at',
        'mobile_verified_at',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function fullName(): Attribute {
        return Attribute::make(
            get: fn() => ($this->first_name !== null) ? $this->first_name . ' ' . $this->last_name : 'ناشناس',
        );
    }

    public function ticketAdmin() {
        return $this->hasOne(TicketAdmin::class);
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);

    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
