<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Models\Market\Delivery;
use App\Models\Market\Province;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Market\SalesProcess\AddressRequest;

class AddressController extends Controller
{
    public function addressAndDelivery()
    {
        $user = Auth::user();
        $cartItems = CartItem::query()->where('user_id', $user->id)->get();
        $addresses = $user->addresses;
        $provinces = Province::all();
        $deliveryMethods = Delivery::query()->where('status', 1)->get();

        // check cart
        $cartItem = CartItem::query()->where('user_id', $user->id)->count();
        if (empty($cartItem))
            return redirect()->route('customer.sales-process.cart');

        return view('customer.sales-process.address-and-delivery', compact('cartItems', 'addresses', 'provinces', 'deliveryMethods'));
    }

    public function addAddress(AddressRequest $request)
    {
        $user = Auth::user();
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $inputs['postal_code'] = convertArabicToEnglish($request->postal_code);
        $inputs['postal_code'] = convertPersianToEnglish($inputs['postal_code']);
        Address::query()->create($inputs);
        return redirect()->back()->with('alert-section-success', 'آدرس جدید با موفقیت اضافه شد');
    }

    public function updateAddress(Address $address, AddressRequest $request)
    {
        $user = Auth::user();
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $inputs['postal_code'] = convertArabicToEnglish($request->postal_code);
        $inputs['postal_code'] = convertPersianToEnglish($inputs['postal_code']);
        $address->update($inputs);
        return redirect()->back()->with('alert-section-success', 'آدرس شما با موفقیت ویرایش شد');
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
