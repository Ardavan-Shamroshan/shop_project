@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>تکمیل فرآیند پرداخت</title>
@endsection
@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start content header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>تکمیل اطلاعات حساب کاربری</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start content header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small"> کد تخفیف </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>

                                <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <section>
                                        کد تخفیف خود را در این بخش وارد کنید.
                                    </section>
                                </section>

                                @if ($errors->any())
                                    <section class="payment-alert alert alert-danger d-flex align-items-center p-2" role="alert">
                                        <i class="fa fa-exclamation-triangle flex-shrink-0 me-2"></i>
                                        @foreach ($errors->all() as $message)
                                            <section>
                                                {{ $message }}
                                            </section>
                                        @endforeach
                                    </section>
                                @endif

                                <section class="row">
                                    <section class="col-md-5">
                                        <form action="{{ route('customer.sales-process.coupon-discount') }}" method="post">
                                            @csrf
                                            <section class="input-group input-group-sm">
                                                <input type="text" name="coupon" class="form-control" placeholder="کد تخفیف را وارد کنید">
                                                <button class="btn btn-primary" type="submit">اعمال کد</button>
                                            </section>
                                        </form>
                                    </section>

                                </section>
                            </section>

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start content header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب نوع پرداخت </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="payment-select">

                                    <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <section>
                                            برای پیشگیری از انتقال ویروس کرونا پیشنهاد می کنیم روش پرداخت اینترنتی رو پرداخت کنید.
                                        </section>
                                    </section>

                                    <form action="{{ route('customer.sales-process.payment-submit') }}" method="post" id="payment_submit">
                                        @csrf

                                        <input type="radio" name="payment_type" value="1" id="d1">
                                        <label for="d1" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-credit-card mx-1"></i>
                                                پرداخت آنلاین
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                درگاه پرداخت زرین پال
                                            </section>
                                        </label>

                                        <section class="mb-2"></section>

                                        <input type="radio" name="payment_type" value="2" id="d2">
                                        <label for="d2" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-id-card-alt mx-1"></i>
                                                پرداخت آفلاین
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                حداکثر در 2 روز کاری بررسی می شود
                                            </section>
                                        </label>

                                        <section class="mb-2"></section>

                                        <input type="radio" name="payment_type" value="3" id="cash_payment">
                                        <label for="cash_payment" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-money-check mx-1"></i>
                                                پرداخت در محل
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                پرداخت به پیک هنگام دریافت کالا
                                            </section>
                                        </label>

                                    </form>

                                </section>
                            </section>

                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                @php
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp

                                @foreach ($cartItems as $cartItem)
                                    @php
                                        $totalProductPrice += $cartItem->cartItemProductPrice() * $cartItem->number;
                                        $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->number;
                                    @endphp
                                @endforeach

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                    <p class="text-muted">
                                        <span id="total_product_price">{{ priceFormat($totalProductPrice) }}</span>
                                    </p>
                                </section>

                                @if ($totalDiscount != 0)
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالاها</p>
                                        <p class="text-danger fw-bolder">
                                            <span id="total_discount">{{ priceFormat($totalDiscount) }}</span>
                                        </p>
                                    </section>
                                @endif


                                @if ($order->commonDiscount != null)
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted"> تخفیف عمومی کالاها</p>
                                        <p class="text-danger fw-bolder">
                                            <span id="total_discount">{{ discountFormat($order->commonDiscount->percentage) }}</span>
                                        </p>
                                    </section>
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted"> حداکثر تخفیف عمومی کالاها</p>
                                        <p class="text-danger fw-bolder">
                                            <span id="total_discount">{{ priceFormat($order->commonDiscount->discount_ceiling) }}</span>
                                        </p>
                                    </section>
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted"> حداقل موجودی سبد</p>
                                        <p class="text-danger fw-bolder">
                                            <span id="total_discount">{{ priceFormat($order->commonDiscount->minimal_order_amount) }}</span>
                                        </p>
                                    </section>
                                @endif

                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder">
                                        <span id="total_price">{{ priceFormat($order->order_final_amount) }}</span>
                                    </p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش
                                    صورت میگیرد. </p>

                                <section>
                                    <button type="button" onclick="document.getElementById('payment_submit').submit();" class="btn btn-danger d-block w-100">تکمیل فرآیند خرید</button>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

@endsection

@section('script')
    <script>
        $(function () {
            $('#cash_payment').click(function () {
                var newDiv = document.createElement('div');
                newDiv.classList = 'col-4';
                newDiv.innerHTML = `
                <section class="input-group input-group-sm">
                    <input type="text" name="cash_receiver" class="form-control" form="payment_submit" placeholder="نام و نام خانوادگی دریافت کننده">
                </section>
                `;

                document.getElementsByClassName('content-wrapper')[1].appendChild(newDiv);


            });


        });

    </script>

@endsection
