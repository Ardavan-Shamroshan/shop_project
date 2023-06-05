@extends('customer.layouts.master-single-col')

@section('content')
    <!-- start slideshow -->
    <section class="container-xxl my-4">
        <section class="row">

            <!-- alerts -->
            @include('customer.alerts.alert-section.success')
            @include('customer.alerts.alert-section.error')
            @include('customer.alerts.alert-section.info')
            <!-- end alerts -->

            <section class="col-md-8 pe-md-1 ">
                <section id="slideshow" class="owl-carousel owl-theme">
                    @forelse ($slideShowImages as $slideShowImage)
                        <section class="item">
                            <a class="w-100 d-block h-auto text-decoration-none" href="{{ urldecode($slideShowImage->url) }}">
                                <img class="w-100 rounded-2 d-block h-auto" src="{{ asset($slideShowImage->image) }}" alt="{{ $slideShowImage->title }}">
                            </a>
                        </section>
                    @empty
                    @endforelse
                </section>
            </section>
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @forelse ($topBanners as $topBanner)
                    <section class="mb-2">
                        <a href="#" class="d-block">
                            <img class="w-100 rounded-2" src="{{ asset($topBanner->image) }}" alt="{{ $topBanner->title }}">
                        </a>
                    </section>
                @empty
                @endforelse
            </section>
        </section>
    </section>
    <!-- end slideshow -->



    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پربازدیدترین کالاها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @forelse ($mostVisitedProducts as $mostVisitedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                </section>
                                                @auth
                                                    @if($mostVisitedProduct->users->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $mostVisitedProduct) }}">
                                                                <i class="fa fa-heart text-danger"></i></button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $mostVisitedProduct) }}">
                                                                <i class="fa fa-heart"></i></button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $mostVisitedProduct) }}">
                                                            <i class="fa fa-heart"></i></button>
                                                    </section>
                                                @endguest
                                                <a class="product-link" href="{{ route('customer.market.product', $mostVisitedProduct) }}">
                                                    <section class="product-image">
                                                        <img class="" src="{{ $mostVisitedProduct->image['indexArray'][$mostVisitedProduct->image['currentImage']] }}" alt="{{ $mostVisitedProduct->title }}">
                                                    </section>
                                                    <section class="product-colors"></section>
                                                    <section class="product-name">
                                                        <h3>{{ $mostVisitedProduct->name }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        <section class="product-discount">
                                                            @if(!empty($mostVisitedProduct->activeAmazingSales()))
                                                                <span class="product-old-price">{{ priceFormat($mostVisitedProduct->price) }} </span>
                                                                <span class="product-discount-amount">{{ discountFormat($mostVisitedProduct->activeAmazingSales()->percentage) }}</span>
                                                            @endif
                                                        </section>
                                                        @php
                                                            $amazingSale = $mostVisitedProduct->activeAmazingSales();
                                                                if (!empty($amazingSale))
                                                                    $amazingSaleProductPrice = ($mostVisitedProduct->price * $amazingSale->percentage) / 100;
                                                                else
                                                                    $amazingSaleProductPrice = 0;
                                                        @endphp
                                                        <section class="product-price">{{ priceFormat($mostVisitedProduct->price - $amazingSaleProductPrice) }}</section>
                                                    </section>
                                                    <section class="product-colors">
                                                        @forelse($mostVisitedProduct->colors as $mostVisitedProductColor)
                                                            <section class="product-colors-item" style="background-color: {{ $mostVisitedProductColor->color }};"></section>
                                                        @empty
                                                        @endforelse
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @empty
                                @endforelse

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->



    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row py-4">
                @foreach ($middleBanners as $middleBanner)
                    <section class="col-12 col-md-6 mt-2 mt-md-0">
                        <a class="" href="{{ urldecode($middleBanner->url) }}">
                            <img class="d-block rounded-2 w-100" src="{{ $middleBanner->image }}" alt="{{ $middleBanner->title }}">
                        </a>
                    </section>
                @endforeach

            </section>

        </section>
    </section>
    <!-- end ads section -->


    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پیشنهاد آمازون به شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                @foreach ($offerProducts as $offerProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                </section>
                                                @auth
                                                    @if($offerProduct->users->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $offerProduct) }}">
                                                                <i class="fa fa-heart text-danger"></i></button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $offerProduct) }}">
                                                                <i class="fa fa-heart"></i></button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $offerProduct) }}">
                                                            <i class="fa fa-heart"></i></button>
                                                    </section>
                                                @endguest
                                                <a class="product-link" href="{{ route('customer.market.product', $offerProduct) }}">
                                                    <section class="product-image">
                                                        <img class="" src="{{ $offerProduct->image['indexArray'][$offerProduct->image['currentImage']] }}" alt="{{ $offerProduct->title }}">
                                                    </section>
                                                    <section class="product-colors"></section>
                                                    <section class="product-name">
                                                        <h3>{{ $offerProduct->name }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        <section class="product-discount">
                                                            @if(!empty($offerProduct->activeAmazingSales()))
                                                                <span class="product-old-price">{{ priceFormat($offerProduct->price) }} </span>
                                                                <span class="product-discount-amount">{{ discountFormat($offerProduct->activeAmazingSales()->percentage) }}</span>
                                                            @endif
                                                        </section>
                                                        @php
                                                            $amazingSale = $offerProduct->activeAmazingSales();
                                                                if (!empty($amazingSale))
                                                                    $amazingSaleProductPrice = ($offerProduct->price * $amazingSale->percentage) / 100;
                                                                else
                                                                    $amazingSaleProductPrice = 0;
                                                        @endphp
                                                        <section class="product-price">{{ priceFormat($offerProduct->price - $amazingSaleProductPrice) }}</section>
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($offerProduct->colors as $offerProductColor)
                                                            <section class="product-colors-item" style="background-color: {{ $offerProductColor->color }};"></section>
                                                        @endforeach
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
    <!-- end product lazy load -->

    @if (!empty($bottomBanner))
        <!-- start ads section -->
        <section class="mb-3">
            <section class="container-xxl">
                <!-- one column -->
                <section class="row py-4">
                    <section class="col">

                        <a href="{{ urldecode($bottomBanner->url) }}">
                            <img class="d-block rounded-2 w-100" src="{{ asset($bottomBanner->image) }}" alt="{{ $bottomBanner->title }}">
                        </a>

                    </section>

                </section>

            </section>
        </section>
        <!-- end ads section -->
    @endif




    <!-- start brand part-->
    <section class="brand-part mb-4 py-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start content header -->
                    <section class="content-header">
                        <section class="d-flex align-items-center">
                            <h2 class="content-header-title">
                                <span>برندهای ویژه</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start content header -->
                    <section class="brands-wrapper py-4">
                        <section class="brands dark-owl-nav owl-carousel owl-theme">
                            @foreach ($brands as $brand)
                                <section class="item">
                                    <section class="brand-item">
                                        <a href="{{ route('customer.products', ['brands[]'=> $brand]) }}"><img class="rounded-2" src="{{ asset($brand->logo['indexArray']['medium']) }}" alt=""></a>
                                    </section>
                                </section>
                            @endforeach

                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end brand part-->



    <!-- toast -->
    {{-- <div aria-live="polite" aria-atomic="true" class="position-fixed p-4 flex-row-reverse" style="z-index: 1000; right: 0; top: 3rem; width: 26rem; max-width: 80%">
        <div class="toast shadow-sm" style="position: absolute; top: 0; right: 0;" data-delay="10000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header d-flex justify-content-between">
                <img src="{{ asset('customer-assets/assets/images/logo/8.png') }}" class="rounded mr-2" alt="فروشگاه آمازون">
                <strong class="mr-auto">فروشگاه آمازون</strong>
                <small>{{ jalaliDate('now - 1 minutes', true) }}</small>
                <button type="button" class="btn btn-sm ml-2 mb-1 close border-none rounded-pill" data-dismiss="toast" aria-label="Close">
                    <strong aria-hidden="true">&times;</strong>
                </button>
            </div>
            <div class="toast-body d-flex justify-content-between">
                <span>  برای افزودن کالا به علاقه مندی باید ابتدا وارد حساب کاربری خود شوید</span>
                <a href="{{ route('auth.customer.loginRegisterForm') }}" class="text-danger text-decoration-none fw-bold">ورورد / ثبت نام</a>
            </div>
        </div>
    </div> --}}

@endsection

@section('script')
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
                            // $(element).children().first().addClass('text-danger');
                            $(elementChildren).addClass('text-danger');
                            $(element).attr('data-bs-original-title', 'حذف از علاقه مندی');
                        } else if (result.status === 2) {
                            // $(element).children().first().removeClass('text-danger');
                            $(elementChildren).removeClass('text-danger');
                            $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی');
                        } else if (result.status === 3) {
                            $('.toast').toast('show')
                        }
                    }
                });
            })
        })
    </script>

@endsection
