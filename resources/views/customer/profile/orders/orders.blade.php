@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>سفارشات شما </title>
@endsection
@section('content')

    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <!-- profile sidebar -->
                    @include('customer.layouts.partials.profile-sidebar')
                <!-- end profile sidebar -->

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <!-- start content header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تاریخچه سفارشات</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->

                        <section class="d-flex justify-content-center my-4">
                            <a class="btn btn-sm mx-1 btn-outline-primary @if (!isset(request()->all()['type'])) btn-primary text-white @endif" href="{{ route('customer.profile.orders') }}">همه</a>
                            <a class="btn btn-sm mx-1 btn-outline-info @if (isset(request()->all()['type']) && request()->all()['type'] == '0') btn-info text-white @endif" href="{{ route('customer.profile.orders', 'type=0') }}">در انتظار تایید</a>
                            <a class="btn btn-sm mx-1 btn-outline-warning @if (isset(request()->all()['type']) && request()->all()['type'] == '2') btn-warning text-white @endif" href="{{ route('customer.profile.orders', 'type=2') }}">تایید نشده</a>
                            <a class="btn btn-sm mx-1 btn-outline-success @if (isset(request()->all()['type']) && request()->all()['type'] == '1') btn-success text-white @endif" href="{{ route('customer.profile.orders', 'type=1') }}">تایید شده</a>
                            <a class="btn btn-sm mx-1 btn-outline-danger @if (isset(request()->all()['type']) && request()->all()['type'] == '4') btn-danger text-white @endif" href="{{ route('customer.profile.orders', 'type=4') }}">مرجوعی</a>
                            <a class="btn btn-sm mx-1 btn-outline-dark @if (isset(request()->all()['type']) && request()->all()['type'] == '3') btn-dark text-white @endif" href="{{ route('customer.profile.orders', 'type=3') }}">لغو شده</a>
                        </section>

                        <!-- start content header -->
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small"> در انتظار پرداخت </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->

                        <section class="order-wrapper">
                            @forelse ($orders as $order)
                                <section class="order-item">
                                    <section class="d-flex justify-content-between">
                                        <section>
                                            <section class="order-item-date">
                                                <i class="fa fa-calendar-alt"></i> {{ jalaliDate($order->created_at, '%d %B %Y') }}
                                            </section>
                                            <section class="order-item-id">
                                                <i class="fa fa-id-card-alt"></i>کد سفارش : {{ $order->id }}</section>
                                            <section class="order-item-status">
                                                <i class="fa fa-clock"></i> {{ $order->paymentStatusValue }}</section>

                                            <section class="order-item-products">
                                                @forelse($order->orderItems as $orderItems)
                                                <a href="{{ route('customer.market.product', $orderItems->singleProduct) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $orderItems->singleProduct->name }}">
{{--                                                    <img src="{{ asset($orderItems->singleProduct->image['indexArray']['small']) }}" alt="{{ $orderItems->singleProduct->name }}">--}}
                                                    <img src="{{ asset(json_decode($orderItems->product)->image->indexArray->small) }}" alt="{{ $orderItems->singleProduct->name }}">
                                                </a>
                                                @empty @endforelse

                                            </section>

                                        </section>
                                        <section class="order-item-link"><a href="#">پرداخت سفارش</a></section>
                                    </section>
                                </section>
                            @empty
                                <section class="order-item">
                                    <section class="flex justify-content-between text-muted font-">
                                        <strong>سفارشی یافت نشد...</strong>
                                    </section>
                                </section>
                            @endforelse

                        </section>

                    </section>
                </main>
            </section>
        </section>
    </section>

@endsection
