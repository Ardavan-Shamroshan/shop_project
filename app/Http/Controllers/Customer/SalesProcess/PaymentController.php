<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Market\CashPayment;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\Payment;
use Illuminate\Http\Request;
use App\Models\Market\Coupon;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment() {
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

    public function couponDiscount(Request $request) {
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

    public function paymentSubmit(Request $request) {
        // payment method should be selected
        $request->validate([
            'payment_type' => 'required',
        ]);

        // get the user order
        $order = Order::query()->where('user_id', Auth::id())->where('order_status', 0)->first();
        // get the user cart items
        $cartItems = CartItem::query()->where('user_id', Auth::id())->get();
        // needed if payment method was cash payment
        $cash_receiver = null;

        // check what payment method is? 1 => online payment, 2 => offline payment, 3 => cash payment
        switch ($request->payment_type) {
            case '1':
                // create an instance from model
                $targetModel = OnlinePayment::class;
                $type = 0;
                break;
            case '2':
                $targetModel = OfflinePayment::class;
                $type = 1;
                break;
            case '3':
                $targetModel = CashPayment::class;
                $type = 2;
                $cash_receiver = $request->cash_receiver ?? null;
                break;
            default:
                return back()->withErrors([
                    'error' => 'خطا'
                ]);
        }

        // payment type has defined and should be inserted to it's table (offline payment, online payment, cash payment)
        $paymented = $targetModel::query()->create([
            'amount' => $order->order_final_amount,
            'user_id' => Auth::id(),
            'pay_date' => now(),
            'cash_receiver' => $cash_receiver,
            'status' => 1,
        ]);


        // payment also should be inserted into payment table
        $payment = Payment::query()->create([
            'amount' => $order->order_final_amount,
            'user_id' => Auth::id(),
            'pay_date' => now(),
            'type' => $type,
            'paymentable_id' => $paymented->id,
            'paymentable_type' => $targetModel,
            'status' => 1,
        ]);

        // update order status to 1 => accepted
        $order->update([
            'order_status' => 1,
        ]);

        // empty cart items
        foreach ($cartItems as $cartItem)
            $cartItem->delete();

        return redirect()->route('customer.home')->with('alert-section-success', 'سفارش شما با موفقیت ثبت شد');

    }
}
