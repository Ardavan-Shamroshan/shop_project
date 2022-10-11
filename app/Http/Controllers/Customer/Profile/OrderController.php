<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        if (isset(request()->type)):
            $orders = Auth::user()->orders()->where('order_status', request()->type)->orderBy('id', 'desc')->get();
        else:
            $orders = Auth::user()->orders()->orderBy('id', 'desc')->get();
        endif;
        return view('customer.profile.orders.orders', compact('orders'));
    }
}
