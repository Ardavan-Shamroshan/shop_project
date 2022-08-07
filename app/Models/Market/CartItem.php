<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'guarantee_id',
        'color_id',
        'number',
        'user_id',
        'product_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function guaranty() {
        return $this->belongsTo(Guaranty::class, 'guarantee_id');
    }

    public function color() {
        return $this->belongsTo(ProductColor::class);
    }

    // product price + color price + guaranty price
    public function cartItemProductPrice() {
        $guarantyPriceIncrease = empty($this->guarantee_id) ? 0 : $this->guaranty->price_increase;
        $colorPriceIncrease = empty($this->color_id) ? 0 : $this->color->price_increase;
        return $this->product->price + $guarantyPriceIncrease + $colorPriceIncrease;
    }

    // product price * (discount / 100)
    public function cartItemProductDiscount() {
        $cartItemProductPrice = $this->cartItemProductPrice();
        $productDiscount = empty($this->product->activeAmazingSales()) ? 0 : $cartItemProductPrice * ($this->product->activeAmazingSales()->percentage / 100);
        return $productDiscount;
    }

    // number * ((product price + color price + guaranty price) - discount)
    public function cartItemFinalPrice() {
        $cartItemProductPrice = $this->cartItemProductPrice();
        $productDiscount = $this->cartItemProductDiscount();
        return $this->number * ($cartItemProductPrice - $productDiscount);
    }

    // number * product discount
    public function cartItemFinalDiscount() {
        $productDiscount = $this->cartItemProductDiscount();
        return $this->number * $productDiscount;
    }

}
