@extends('admin.layouts.master')
@section('head-tag')
    <title>نمایش پرداخت</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.payment') }}">پرداختات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش پرداخت</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>نمایش پرداخت</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.payment') }}" class="btn btn-info  border rounded-lg  btn-hover color-8">«
                بازگشت</a>
        </section>

        <section class="card mb-3 mx-5">
            <section class="card-header bg-gray-50">
                <span>{{ $payment->user->fullname }}</span>
                <span> - </span>
                <span>{{ $payment->user->id }}</span>
            </section>
            <section class="card-body">
                <h5 class="card-title"><b>مبلغ :</b>{{ $payment->paymentable->amount }}</h5>
                <h6 class="card-title"><b> شیوه پرداخت :</b>
                    @if($payment->type == 0) آفلاین
                    @elseif($payment->type == 1)  آنلاین
                    @else پرداخت در محل
                    @endif
                </h6>
                <p class="mx-2 card-text"><span class="bg-light radius-05 p-1"> کد محصول : {{ $payment->paymentable_id }}</span></p>
                <p class="mx-2 card-text"><span class="bg-light radius-05 p-1"> دریافت کننده مبلغ : {{ $payment->paymentable->cash_receiver ?? '-' }}</span></p>
                <p class="mx-2 card-text"><span class="bg-light radius-05 p-1"> کد تراکنش : {{ $payment->paymentable->transaction_id ?? '-' }}</span></p>
                <p class="mx-2 card-text"><span class="bg-light radius-05 p-1"> درگاه : {{ $payment->gatewaye ?? '-' }}</span></p>
                <p class="mx-2 card-text"><span class="bg-light radius-05 p-1"> تاریخ پرداخت : {{ jalaliDate($payment->paymentable->pay_date) ?? '-' }}</span></p>
            </section>
        </section>
    </section>
@endsection
