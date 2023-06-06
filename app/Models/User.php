<?php

namespace App\Models;

use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Traits\Permissions\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Nagy\LaravelRating\Traits\CanRate;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, SoftDeletes, HasPermissionsTrait, CanRate;

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

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->first_name !== null) ? $this->first_name . ' ' . $this->last_name : 'ناشناس',
        );
    }

    public function ticketAdmin()
    {
        return $this->hasOne(TicketAdmin::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Could be in both User model and HasPermissionsTrait (only one to choose)
    // public function roles() {
    //     return $this->belongsToMany(Role::class);
    // }

    // Cut and pasted to HasPermissionTrait
    // public function permissions() {
    //     return $this->belongsToMany(Permission::class);
    // }

    public function payments()
    {
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

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }


    /**
     * Get all of the order items for the user.
     */
    public function orderItems()
    {
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }

    /**
     * Methods
     */
    public function isUserPurchasedProduct($product_id)
    {
        $product_ids = collect();
        foreach ($this->orderItems->where('product_id', $product->id)->get() as $item)
            $product_ids->push($item->product_id);
        $product_ids = $product_ids->unique;

        return $product_ids;
    }

}
