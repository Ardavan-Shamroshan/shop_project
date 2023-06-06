@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>سبد خرید</title>
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
                                <span>سبد خرید شما</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9 mb-3">
                            <section class="content-wrapper bg-white p-3 rounded-2">

                                <form action="" id="cart_items" method="post">
                                    @csrf
                                    @php
                                        $totalProductPrice = 0;
                                        $totalDiscount = 0;
                                    @endphp
                                    @if($cartItems->isEmpty())

                                        <section class="col-12">
                                            <h4 class="text-muted w-100 mx-auto">سبد خرید شما خالی است!</h4>
                                            <a href="{{ route('customer.home') }}" class="d-block w-25 text-decoration-none text-info">رفتن به صفحه محصولات » </a>
                                        </section>

                                    @else
                                        @foreach($cartItems as $cartItem)
                                            @php
                                                $totalProductPrice += $cartItem->cartItemProductPrice();
                                                $totalDiscount += $cartItem->cartItemProductDiscount();
                                            @endphp

                                                <section class="cart-item d-md-flex gap-2 py-3">
                                                    <section class="cart-img align-self-start flex-shrink-1">
                                                        <img src="{{ asset($cartItem->product->image['indexArray']['medium']) }}" alt="{{ $cartItem->product->name }}">
                                                    </section>
                                                    <section class="align-self-start w-100">
                                                        <a href="{{ route('customer.market.product', $cartItem->product) }}" class="fw-bold text-decoration-none text-dark">{{  $cartItem->product->name }}</a>
                                                        @if(!empty($cartItem->color))
                                                            <p class="d-flex justify-content-between">
                                                            <span>
                                                                <span style="background-color: {{ $cartItem->color->color }};" class="cart-product-selected-color me-1 border"></span>
                                                                <span>{{ $cartItem->color->color_name }}</span>
                                                            </span>
                                                                <small class="text-success">{{ priceFormat($cartItem->color->price_increase) }}+
                                                                </small>
                                                            </p>
                                                        @endif
                                                        @if(!empty($cartItem->guaranty))
                                                            <p class="d-flex justify-content-between">
                                                                <span><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                                <span> {{ $cartItem->guaranty->name }}</span></span>
                                                                <small class="text-success">{{ priceFormat($cartItem->guaranty->price_increase) }}+
                                                                </small>
                                                            </p>
                                                        @endif

                                                        @if($cartItem->product->marketable_number > 2)
                                                            <p>
                                                                <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                                                <span>کالا موجود در انبار</span>
                                                            </p>
                                                        @elseif($cartItem->product->marketable_number <= 2 && $cartItem->product->marketable_number > 0)
                                                            <p>
                                                                <i class="fa fa-store-alt-slash  text-danger cart-product-selected-store me-1"></i>
                                                                <span class="text-danger fw-bold">تنها {{ $cartItem->product->marketable_number}} عدد در انبار باقی مانده </span>
                                                            </p>
                                                        @else
                                                            <p>
                                                                <i class="fa fa-store-alt-slash  text-danger cart-product-selected-store me-1"></i>
                                                                <span class="text-danger fw-bold"> کالا ناموجود است</span>
                                                            </p>
                                                        @endif
                                                        <section>
                                                            <section class="cart-product-number d-inline-block ">
                                                                <button class="cart-number cart-number-down" type="button">-</button>
                                                                <input class="number" name="number[{{$cartItem->id}}]" data-product-price="{{ $cartItem->cartItemProductPrice() }}" data-product-discount="{{ $cartItem->cartItemProductDiscount() }}" type="number" min="1" max="5" step="1" value="{{ $cartItem->number }}" readonly="readonly">
                                                                <button class="cart-number cart-number-up" type="button">+</button>
                                                            </section>
                                                            <a class="text-decoration-none ms-4 cart-delete" href="{{ route('customer.sales-process.cart.remove-from-cart', $cartItem) }}"><i class="fa fa-trash-alt"></i> حذف از سبد</a>
                                                        </section>
                                                    </section>
                                                    <section class="align-self-end flex-shrink-1 border rounded p-3">
                                                        @if(!empty($cartItem->product->activeAmazingSales()))

                                                        <section class="text-nowrap text-muted text-decoration-line-through">{{ priceFormat($cartItem->cartItemProductPrice()) }}</section>
                                                            <section class="cart-item-discount text-danger text-nowrap mb-1">{{ priceFormat($cartItem->cartItemProductDiscount()) }} -</section>
                                                        @endif
                                                        <section class="text-nowrap fw-bold">{{ priceFormat($cartItem->cartItemProductPrice() - $cartItem->cartItemProductDiscount()) }}</section>
                                                    </section>
                                                </section>

                                        @endforeach
                                </form>
                                @endif

                            </section>
                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                    <p class="text-muted" id="total_product_price">{{ priceFormat($totalProductPrice) }}</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder" id="total_discount">{{ priceFormat($totalDiscount) }} - </p>
                                </section>
                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder" id="total_price">{{ priceFormat($totalProductPrice - $totalDiscount) }}</p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                                </p>

                                <section class="">
                                    <a onclick="document.getElementById('cart_items').submit();" class="btn btn-danger d-block">تکمیل فرآیند خرید</a>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط با سبد خرید شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach ($relatedProducts as $relatedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                </section>

                                                @auth
                                                    @if($relatedProduct->users->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}">
                                                                <i class="fa fa-heart text-danger"></i></button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}">
                                                                <i class="fa fa-heart"></i></button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}">
                                                            <i class="fa fa-heart"></i></button>
                                                    </section>
                                                @endguest

                                                <a class="product-link" href="{{ route('customer.market.product', $relatedProduct) }}">

                                                    <section class="product-image">
                                                        <img class="" src="{{ asset($relatedProduct->image['indexArray'][$relatedProduct->image['currentImage']]) }}" alt="{{ $relatedProduct->title }}">
                                                    </section>
                                                    <section class="product-colors"></section>
                                                    <section class="product-name">
                                                        <h3>{{ $relatedProduct->name }}</h3>
                                                    </section>

                                                    @if (!empty($relatedProduct->activeAmazingSales()))
                                                        @php
                                                            $amazingSaleProductPrice = ($relatedProduct->price * $relatedProduct->activeAmazingSales()->percentage) / 100;
                                                        @endphp
                                                        <section class="product-price-wrapper">
                                                            <section class="product-discount">
                                                                <span class="product-old-price text-decoration-line-through">{{ priceFormat($relatedProduct->price) }} </span>
                                                                <span class="product-discount-amount">{{ discountFormat($relatedProduct->activeAmazingSales()->percentage) }}</span>
                                                            </section>
                                                            <section class="product-price content-header-title">{{ priceFormat($relatedProduct->price - $amazingSaleProductPrice) }}</section>
                                                        </section>
                                                    @else
                                                        <section class="product-price-wrapper">
                                                            <section class="product-price content-header-title">{{ priceFormat($relatedProduct->price) }}</section>
                                                        </section>
                                                    @endif

                                                    <section class="product-colors">
                                                        @if ($relatedProduct->colors->isNotEmpty())
                                                            @foreach ($relatedProduct->colors as $key => $color)
                                                                <section class="product-colors-item" style="background-color: {{ $color->color ?? '#fff' }};;"></section>
                                                            @endforeach
                                                        @endif
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>

    <!-- end main one col -->



    <!-- start body -->
    <section class="container-xxl body-container">
        <aside id="sidebar" class="sidebar">

        </aside>
        <main id="main-body" class="main-body">

        </main>
    </section>
    <!-- end body -->

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            bill();

            $('.cart-number').click(function () {
                bill();
            });
        });


        function bill() {
            var total_product_price = 0;
            var total_discount = 0;
            var total_price = 0;

            $('.number').each(function () {
                var product_price = parseFloat($(this).data('product-price'));
                var product_discount = parseFloat($(this).data('product-discount'));
                var number = parseFloat($(this).val());

                total_product_price += product_price * number;
                total_discount += product_discount * number;

            });

            total_price = total_product_price - total_discount;

            $('#total_product_price').html(toFarsiNumber(total_product_price) + ' تومان ');
            $('#total_discount').html(toFarsiNumber(total_discount) + ' تومان ');
            $('#total_price').html(toFarsiNumber(total_price) + ' تومان ');
        }

    </script>
    <script>
        $(document).ready(function () {
            $('.product-add-to-favorite > button').click(function () {
                var url = $(this).attr('data-url');
                var element = $(this);
                var elementChildren = $('.product-add-to-favorite > button[data-url="' + url + '"]').children();


                $.ajax({
                    url: url,
                    success: function (result) {
                        if (result.status === 1) {
                            $(elementChildren).addClass('text-danger');
                            $(element).attr('data-bs-original-title', 'حذف از علاقه مندی');
                        } else if (result.status === 2) {
                            $(elementChildren).removeClass('text-danger');
                            $(element).attr('data-bs-original-title', 'افزودن به علاقه مندی');
                        } else if (result.status === 3) {
                            $('.toast').toast('show')
                        }
                    }
                });
            })
        })
    </script>

@endsection
