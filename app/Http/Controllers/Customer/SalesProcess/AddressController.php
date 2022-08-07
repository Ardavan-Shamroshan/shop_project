<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addressAndDelivery() {
        // check profile
        $user = Auth::user();

        if (
            empty($user->mobile) ||
            empty($user->first_name) ||
            empty($user->last_name) ||
            empty($user->email) ||
            empty($user->national_code)
        )
            return redirect()->route('customer.sales-process.profile-completion');

        // check cart
        $cartItem = CartItem::query()->where('user_id', $user->id)->count();
        if(empty($cartItem))
            return redirect()->route('customer.sales-process.cart');


        return view('customer.sales-process.address-and-delivery');
    }

    public function addAddress() {
        dd('addAddress');
    }
}
