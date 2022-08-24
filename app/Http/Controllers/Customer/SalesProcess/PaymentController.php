<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Coupon;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment()
    {
        $user = Auth::user();
        $cartItems = CartItem::query()->where('user_id', $user->id)->get();
        // fetch users order
        $order = Order::query()->where([
            ['user_id', $user->id],
            ['order_status', 0],
        ])->first();

        // check cart
        $cartItem = CartItem::query()->where('user_id', $user->id)->count();
        if (empty($cartItem))
            return redirect()->route('customer.sales-process.cart');

        return view('customer.sales-process.payment', compact('cartItems', 'order'));
    }

    public function couponDiscount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'coupon' => 'required',
        ]);

        // find coupon code
        $coupon = Coupon::query()->where([
            ['code', $request->coupon],
            ['status', 1],
            ['end_date', '>', now()],
            ['start_date', '<', now()]
        ])->first();

        // check coupon is found
        if (empty($coupon))
            return redirect()->back()->with('alert-section-error', 'کد تخفیف نامعتبر است');

        // check coupon code is private
        elseif ($coupon->user_id != null) {
            // check coupon code is for the logged in user
            $coupon = Coupon::query()->where([
                ['code', $request->coupon],
                ['status', 1],
                ['end_date', '>', now()],
                ['start_date', '<', now()],
                ['user_id', $user->id],
            ])->first();
            // coupon code is not valid
            if (empty($coupon))
                return redirect()->back()->with('alert-section-error', 'کد تخفیف نامعتبر است');
        }

        // fetch users order
        $order = Order::query()->where([
            ['user_id', $user->id],
            ['order_status', 0],
            ['coupon_id', null],
        ])->first();
        if ($order) {
            // check coupon amount type is percentage or price unit
            if ($coupon->amount_type == 0) {
                $couponDiscountAmount = $order->order_final_amount * ($coupon->amount / 100);
                // check coupon discount amount ceiling
                if ($couponDiscountAmount > $coupon->discount_ceiling)
                    $couponDiscountAmount = $coupon->discount_ceiling;
            } else
                $couponDiscountAmount = $coupon->amount;

            // final total price
            $order->order_final_amount -= $couponDiscountAmount;

            // final total discount
            $finalDiscount = $order->order_total_products_discount_amount + $couponDiscountAmount;

            $order->update([
                'coupon_id' => $coupon->id,
                'order_coupon_discount_amount' => $couponDiscountAmount,
                'order_total_products_discount_amount' => $finalDiscount,
            ]);

            return redirect()->back()->with('alert-section-success', 'کد تخفیف با موفقیت اعمال شد');
        } else {
            return redirect()->back()->with('alert-section-error', 'کد تخفیف قبلا استفاده شده است');
        }
    }
}
