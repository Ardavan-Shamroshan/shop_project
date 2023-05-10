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
use App\Http\Requests\Market\SalesProcess\ChooseAddressAndDeliveryRequest;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Order;

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

    public function chooseAddressAndDelivery(ChooseAddressAndDeliveryRequest $request)
    {
        $user = Auth::user();
        $inputs = $request->all();

        // calc price with amazing sales
        $cartItems = CartItem::query()->where('user_id', $user->id)->get();
        $totalProductPrice = 0;
        $totalDiscountPrice = 0;
        $totalFinalPrice = 0;
        $totalFinalDiscountPriceWithNumbers = 0;
        foreach ($cartItems as $cartItem) {
            $totalProductPrice += $cartItem->cartItemProductPrice();
            $totalDiscountPrice += $cartItem->cartItemProductDiscount();
            $totalFinalPrice += $cartItem->cartItemFinalPrice();
            $totalFinalDiscountPriceWithNumbers += $cartItem->cartItemFinalDiscount();
        }

        // common discount
        $commonDiscount = CommonDiscount::query()->where('status', 1)->where('end_date', '>=', now())->where('start_date', '<=', now())->first();
        if ($commonDiscount) {
            $inputs['common_discount_id'] = $commonDiscount->id;
            $commonPercentageDiscountAmount = $totalFinalPrice * ($commonDiscount->percentage / 100);

            // check maximum discountable amount
            if ($commonPercentageDiscountAmount > $commonDiscount->discount_ceiling)
                $commonPercentageDiscountAmount = $commonDiscount->discount_ceiling;

            // check minimum order amount
            if ($commonDiscount != null && $totalFinalPrice >= $commonDiscount->minimal_order_amount)
                $finalPrice = $totalFinalPrice - $commonPercentageDiscountAmount;
            else
                $finalPrice = $totalFinalPrice;
        } else {
            $finalPrice = $totalFinalPrice;
            $commonPercentageDiscountAmount = null;
        }


        $inputs['user_id'] = $user->id;
        $inputs['order_final_amount'] = $finalPrice;
        $inputs['order_discount_amount'] = $totalFinalDiscountPriceWithNumbers;
        $inputs['order_common_discount_amount'] = $commonPercentageDiscountAmount;
        $inputs['order_total_product_discount_amount'] = $inputs['order_discount_amount'] + $inputs['order_common_discount_amount'];
        // register order
        $order = Order::query()->updateOrCreate([
            'user_id' => $user->id,
            'order_status' => 0 // not paid
        ], $inputs);
        return redirect()->route('customer.sales-process.payment');
    }

    // method for fetch cities from db for ajax
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
