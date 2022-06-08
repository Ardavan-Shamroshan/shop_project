<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all()
    {
        $orders = Order::all();
        return view('admin.market.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.market.order.show', compact('order'));
    }

    public function detail(Order $order)
    {
        return view('admin.market.order.detail', compact('order'));
    }

    public function newOrders()
    {
        $orders = Order::query()->where('order_status', 0)->get();
        foreach ($orders as $order) {
            $order->order_status = 1;
            $order->save();
        }
        return view('admin.market.order.index', compact('orders'));
    }

    public function sending()
    {
        $orders = Order::query()->where('delivery_status', 1)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function unpaid()
    {
        $orders = Order::query()->where('payment_status', 1)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function canceled()
    {
        $orders = Order::query()->where('order_status', 4)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function returned()
    {
        $orders = Order::query()->where('order_status', 5)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function changeSendStatus(Order $order)
    {
        switch ($order->delivery_status) {
            case 0:
                $order->delivery_status = 1;
                break;
            case 1:
                $order->delivery_status = 2;
                break;
            case 2:
                $order->delivery_status = 3;
                break;
            default:
                $order->delivery_status = 0;
        }
        $order->save();
        return back();
    }

    public function changeOrderStatus(Order $order)
    {
        switch ($order->order_status) {
            case 1: // awaiting approval
                $order->order_status = 2;
                break;
            case 2: // approved
                $order->order_status = 3;
                break;
            case 3: // not approved
                $order->order_status = 4;
                break;
            case 4: // voided
                $order->order_status = 5; // returned
                break;
            default:
                $order->order_status = 1;
        }
        $order->save();
        return back();
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }
}
