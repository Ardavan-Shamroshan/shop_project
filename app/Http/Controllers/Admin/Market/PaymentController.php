<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Payment;
use App\Http\Controllers\Controller;
class PaymentController extends Controller {
    public function index() {
        $payments = Payment::all();
        return view('admin.market.payment.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('admin.market.payment.show', compact('payment'));
    }

    public function online() {
        $payments = Payment::query()->orderBy('created_at', 'desc')->where('paymentable_type', 'App\Models\Market\OnlinePayment')->simplePaginate(15);
        return view('admin.market.payment.index', compact('payments'));
    }

    public function offline() {
        $payments = Payment::query()->orderBy('created_at', 'desc')->where('paymentable_type', 'App\Models\Market\OfflinePayment')->simplePaginate(15);
        return view('admin.market.payment.index', compact('payments'));
    }

    public function cash() {
        $payments = Payment::query()->orderBy('created_at', 'desc')->where('paymentable_type', 'App\Models\Market\CashPayment')->simplePaginate(15);
        return view('admin.market.payment.index', compact('payments'));
    }

    public function canceled(Payment $payment) {
        $payment->status = 2;
        $payment->save();
        return redirect()->route('admin.market.payment')->with('swal-success', 'وضعیت پرداخت با موفقیت تغییر کرد');
    }

    public function returned(Payment $payment) {
        $payment->status = 3;
        $payment->save();
        return redirect()->route('admin.market.payment')->with('swal-success', 'وضعیت پرداخت با موفقیت تغییر کرد');
    }
}
