<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment()
    {
        $user = Auth::user();
        $cartItems = CartItem::query()->where('user_id', $user->id)->get();

        // check cart
        $cartItem = CartItem::query()->where('user_id', $user->id)->count();
        if (empty($cartItem))
            return redirect()->route('customer.sales-process.cart');

        return view('customer.sales-process.payment', compact('cartItems'));
    }
}
