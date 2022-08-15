<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Models\Market\Province;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addressAndDelivery()
    {
        $user = Auth::user();
        $cartItems = CartItem::query()->where('user_id', $user->id)->get();
        $addresses = $user->addresses;
        $provinces = Province::all();

        // check cart
        $cartItem = CartItem::query()->where('user_id', $user->id)->count();
        if (empty($cartItem))
            return redirect()->route('customer.sales-process.cart');

        return view('customer.sales-process.address-and-delivery', compact('cartItems', 'addresses', 'provinces'));
    }

    public function addAddress()
    {
        dd('addAddress');
    }

    public function getCities(Province $province)
    {
        $cities = $province->cities;
        if (!empty($cities))
            return response()->json([
                'status' => true,
                'cities' => $cities,
            ]);
        else
            return response()->json([
                'status' => false,
                'cities' => null,
            ]);
    }
}
