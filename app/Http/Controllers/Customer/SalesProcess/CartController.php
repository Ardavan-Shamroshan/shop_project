<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart() {
        if (Auth::check()) {
            $cartItems = CartItem::query()->where('user_id', Auth::user()->id)->get();
            $relatedProducts = Product::with('colors', 'amazingSales')->get();
            return view('customer.sales-process.cart', compact('cartItems', 'relatedProducts'));
        } else return redirect()->route('auth.customer.loginRegisterForm');
    }

    public function addToCart(Product $product, Request $request) {
        if (Auth::check()) {
            $validated = $request->validate([
                'color' => 'nullable|exists:product_colors,id',
                'guaranty' => 'nullable|exists:guarantees,id',
                'number' => 'numeric|min:1|max:5'
            ]);
            $cartItems = CartItem::query()->where('product_id', $product->id)->where('user_id', auth()->user()->id)->get();
            if (!isset($request->color))
                $request->color = null;
            if (!isset($request->guaranty))
                $request->guaranty = null;
            foreach ($cartItems as $cartItem) {
                if ($cartItem->color_id == $request->color && $cartItem->guarantee_id == $request->guaranty) {
                    if ($cartItem->number != $request->number) {
                        $cartItem->update(['number' => $request->number]);
                        return back()->with('alert-section-success', 'تعداد سفارش محصول مورد نظر با موفقیت تغییر کرد');
                    }
                    return back()->with('alert-section-success', 'این محصول در سبد خرید شما وجود دارد');
                }
            }
            $inputs = [];
            $inputs['color_id'] = $request->color;
            $inputs['guarantee_id'] = $request->guaranty;
            $inputs['user_id'] = auth()->user()->id;
            $inputs['product_id'] = $product->id;
            CartItem::query()->create($inputs);
            return back()->with('alert-section-success', 'محصول مورد نظر با موفقیت به سبد خرید اضافه شد');
        } else
            return redirect()->route('auth.customer.loginRegisterForm');
    }

    public function updateCart(Request $request) {
        $inputs = $request->all();
        $cartItems = CartItem::query()->where('user_id', Auth::user()->id)->get();
        foreach ($cartItems as $cartItem) {
            if (isset($inputs['number'][$cartItem->id]))
                $cartItem->update([
                    'number' => $inputs['number'][$cartItem->id]
                ]);
        }
        return redirect()->route('customer.sales-process.address-and-delivery');
    }

    public function removeFromCart(CartItem $cartItem) {
        if ($cartItem->user_id === Auth::user()->id)
            $cartItem->forceDelete();

        return back();
    }
}
