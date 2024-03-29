@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>{{ $product->name }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>

    <style>
        /***
 *  Simple Pure CSS Star Rating Widget Bootstrap 4
 *
 *  www.TheMastercut.co
 *
 ***/
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

        /* Styling h1 and links
        ––––––––––––––––––––––––––––––––– */
        .starrating > input {
            display: none;
        }

        /* Remove radio buttons */

        .starrating > label:before {
            content: "\f005"; /* Star */
            margin: 2px;
            font-size: 1.2em;
            font-family: FontAwesome;
            display: inline-block;
        }

        .starrating > label {
            color: #222222; /* Start color when not clicked */
        }

        .starrating > input:checked ~ label {
            color: #ffca08;
        }

        /* Set yellow color when star checked */

        .starrating > input:hover ~ label {
            color: #ffca08;
        }

        /* Set yellow color when star hover */
    </style>
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
                                <span>{{ $product->name }}</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <!-- start add to cart form -->
                    <form action="{{ route('customer.sales-process.cart.add-to-cart', $product) }}" id="add_to_cart" method="post">
                        @csrf

                        <section class="row mt-4">
                            <!-- start image gallery -->
                            <section class="col-md-4">
                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                    <section class="product-gallery">

                                        <section class="product-gallery-selected-image mb-3">
                                            <img src="{{ asset($productImages->first()['indexArray']['medium']) }}" alt="">
                                        </section>
                                        <section class="product-gallery-thumbs">
                                            @forelse ($productImages as $key => $gallery)
                                                <img class="product-gallery-thumb" src="{{ asset($gallery['indexArray']['medium']) }}" alt="{{ $product->name . '-' . ($key + 1) }}" data-input="{{ asset($gallery['indexArray']['medium']) }}">
                                            @empty @endforelse
                                        </section>

                                    </section>
                                </section>
                            </section>
                            <!-- end image gallery -->

                            <!-- start product info -->
                            <section class="col-md-5">

                                <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                    <!-- start content header -->
                                    <section class="content-header mb-3">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h2 class="content-header-title content-header-title-small">
                                                {{ $product->name }}
                                            </h2>
                                            <section class="content-header-link">
                                                <!--<a href="#">مشاهده همه</a>-->
                                            </section>
                                        </section>
                                    </section>

                                    <section class="product-info">

                                        @if ($productColors->isNotEmpty())
                                            <p>
                                                <span>رنگ انتخاب شده : <span id="selected_color_name">{{ $productColors->first()->color_name }}</span></span>
                                            </p>
                                            <p>
                                                @forelse ($productColors as $key => $color)
                                                    <label for="{{ "color_$color->id" }}" style="background-color: {{ $color->color ?? '#fff' }};" class="product-info-colors me-1 border border-4 border-light p-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                           title={{ $color->color_name }}></label>
                                                    <input type="radio" name="color" id="{{ "color_$color->id" }}" class="d-none" value="{{ $color->id }}" data-color-name="{{ $color->color_name }}" data-color-price="{{ $color->price_increase }}" @checked($key === 0)>
                                                @empty @endforelse
                                            </p>
                                        @endif

                                        @if (count($productGuaranties) != 0)
                                            <p>
                                                <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                گارانتی :
                                                <select name="guaranty" id="guaranty" class="p-1 border rounded-lg">
                                                    @forelse ($productGuaranties as $key => $guaranty)
                                                        <option value="{{ $guaranty->id }}" data-guaranty-price="{{ $guaranty->price_increase }}" @selected($key === 0)>{{ $guaranty->name }}</option>
                                                    @empty @endforelse

                                                </select>
                                            </p>
                                        @endif

                                        @if ($product->marketable_number > 0)
                                            <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                                <span>کالا موجود در انبار</span></p>
                                        @else
                                            <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                                <span>کالا ناموجود</span></p>
                                        @endif

                                        <div class="d-flex gap-2">
                                            <p class="product-add-to-favorite product-add-to-favorite-disable-styles">
                                                @guest
                                                    <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-favorite', $product) }}">
                                                        <i class="fa fa-heart"></i>
                                                        <span>افزودن به علاقه مندی</span>
                                                    </button>
                                                @endguest
                                                @auth
                                                    @if($product->users->contains(auth()->user()->id))
                                                        <button type="button" class="btn btn-light  btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-favorite', $product) }}">
                                                            <i class="fa fa-heart text-danger"></i>
                                                            <span>حذف از علاقه مندی</span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-favorite', $product) }}">
                                                            <i class="fa fa-heart"></i> <span>افزودن به علاقه مندی</span>
                                                        </button>
                                                    @endif
                                                @endauth
                                            </p>

                                            <div class="product-add-to-compare product-add-to-compare-disable-styles">
                                                @guest
                                                    <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-compare', $product) }}">
                                                        <i class="fa fa-border-all"></i>
                                                        <span>مقایسه محصول</span>
                                                    </button>
                                                @endguest
                                                @auth
                                                    @if($product->compares->contains(function ($compare, $key) {
                                                            return $compare->id == auth()->user()->compare->id;
                                                    }))
                                                        <button type="button" class="btn btn-light  btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-compare', $product) }}">
                                                            <i class="fa fa-border-all text-danger"></i>
                                                            <span>مقایسه محصول </span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.product.add-to-compare', $product) }}">
                                                            <i class="fa fa-border-all"></i> <span>افزودن به علاقه مندی</span>
                                                        </button>
                                                    @endif
                                                @endauth
                                            </div>

                                        </div>
                                        <section>
                                            <section class="cart-product-number d-inline-block ">
                                                <button class="cart-number cart-number-down" type="button">-</button>
                                                <input type="number" id="number" name="number" min="1" max="5" step="1" value="1" readonly="readonly">
                                                <button class="cart-number cart-number-up" type="button">+</button>
                                            </section>
                                        </section>

                                        <p class="mb-3 mt-5">
                                            <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت
                                            پرداخت این
                                            سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه ارسال که شما انتخاب کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                        </p>
                                    </section>

                                </section>

                            </section>
                            <!-- end product info -->

                            <section class="col-md-3">
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    @if ($product->marketable_number > 0)
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">قیمت کالا</p>
                                            <p class="text-muted @if(!empty($amazingSale)) text-decoration-line-through @endif" id="product_price" data-product-original-price="{{ $product->price }}">{{ priceFormat($product->price) }} </p>
                                        </section>

                                        @if (!empty($amazingSale))
                                            <section class="d-flex justify-content-between align-items-center">
                                                <p class="text-muted">تخفیف کالا</p>
                                                <p class="text-light badge bg-danger rounded-lg" id="product_discount_price" data-product-discount-price="{{ $amazingSale->percentage }}">{{ discountFormat($amazingSale->percentage) }}</p>
                                            </section>

                                            <section class="border-bottom mb-3"></section>

                                            <section class="d-flex justify-content-end align-items-center">
                                                <p class="fw-bolder" id="final_price">{{  priceFormat($product->price - $amazingSaleProductPrice) }}</p>
                                            </section>

                                            <section class="">
                                                <button id="next-level" type="submit" class="btn btn-danger d-block w-100" onclick="document.getElementById('add_to_cart').submit();">افزودن به سبد</button>
                                            </section>
                                        @else
                                            <section class="">
                                                <button id="next-level" type="submit" class="btn btn-danger d-block w-100">افزودن به سبد</button>
                                            </section>
                                        @endif
                                    @else
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h3 class="text-muted fw-bold">ناموجود</h3>
                                        </section>

                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted text-justify">این کالا فعلا موجود نیست اما می‌توانید زنگوله را بزنید تا به محض موجود شدن، به شما خبر دهیم </p>
                                        </section>

                                        <section class="border-bottom mb-3"></section>

                                        <section class="">
                                            <a id="next-level" href="#" class="btn btn-danger d-block"><i class="far fa-bell"></i> خبرم کنید
                                            </a>
                                        </section>
                                    @endif
                                </section>
                            </section>
                        </section>

                    </form>
                    <!-- end add to cart form -->

                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

    <!-- start product lazy load -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @each('customer.layouts.partials.product.product-item', $relatedProducts, 'relatedProduct')

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->

    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#introduction">معرفی</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start content header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">
                                {!! $product->introduction !!}
                            </section>

                            <!-- start content header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">
                                    @forelse($product->values as $value)
                                        <tr class="border-2">
                                            <td>{{ $value->attribute->name }}</td>
                                            <td>{{ json_decode($value->value)->value }} {{ $value->attribute->unit }}</td>
                                        </tr>
                                    @empty @endforelse
                                    @forelse($product->metas as $meta)
                                        <tr class="border-2">
                                            <td>{{ $meta->meta_key }}</td>
                                            <td>{{ $meta->meta_value }}</td>
                                        </tr>
                                    @empty @endforelse
                                </table>
                            </section>

                            <!-- start content header -->
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        امتیاز و دیدگاه کاربران </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-comments mb-4">
                                @auth
                                    @if(auth()->user()->isUserPurchasedProduct($product->id))
                                        <form class="mb-4" method="get" action="{{ route('customer.market.product.add-rate', $product) }}">
                                            <p class="content-header-title-small text-muted mb-0">هنوز امتیازی ثبت نشده است</p>
                                            <div class="starrating risingstar d-flex justify-content-end flex-row-reverse mb-1">
                                                <input type="submit" id="star5" name="rating" value="5"/><label for="star5" title="5 star"></label>
                                                <input type="submit" id="star4" name="rating" value="4"/><label for="star4" title="4 star"></label>
                                                <input type="submit" id="star3" name="rating" value="3"/><label for="star3" title="3 star"></label>
                                                <input type="submit" id="star2" name="rating" value="2"/><label for="star2" title="2 star"></label>
                                                <input type="submit" id="star1" name="rating" value="1"/><label for="star1" title="1 star"></label>
                                            </div>
                                        </form>
                                        <p class="content-header-title-small text-muted mt-0">میانگین امتیاز: {{ number_format($product->ratingsAvg(), 1,'/') }}</p>
                                    @endif
                                @endauth
                                @guest
                                    <section class="product-comment">
                                        <section class="product-comment-header d-flex justify-content-start">
                                            <section class="product-comment-title">برای امتیاز دهی باید
                                                <a href="{{ route('auth.customer.loginRegisterForm') }}" class="text-decoration-none">وارد بشوید</a>.
                                            </section>
                                        </section>
                                    </section>
                                @endguest

                                <section class="comment-add-wrapper">
                                    <button class="comment-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-comment">
                                        <i class="fa fa-plus"></i> افزودن دیدگاه
                                    </button>
                                    <!-- start add comment Modal -->
                                    <section class="modal fade" id="add-comment" tabindex="-1" aria-labelledby="add-comment-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-comment-label">
                                                        <i class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </section>

                                                @auth

                                                    <section class="modal-body">
                                                        <form class="row" action="{{ route('customer.market.product.add-comment', $product) }}" method="post">
                                                            @csrf
                                                            <section class="col-12 mb-2">
                                                                <label for="comment" class="form-label mb-1">دیدگاه شما</label>
                                                                <textarea class="form-control form-control-sm" name="body" id="comment" placeholder="دیدگاه شما ..." rows="4"></textarea>
                                                            </section>
                                                            <section class="modal-footer py-1">
                                                                <button type="submit" class="btn btn-sm btn-primary">ثبت دیدگاه</button>
                                                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                            </section>
                                                        </form>
                                                    </section>

                                                @endauth
                                                @guest
                                                    <section class="product-comment">
                                                        <section class="product-comment-header d-flex justify-content-start">
                                                            <section class="product-comment-title">برای نوشتن دیدگاه باید
                                                                <a href="{{ route('auth.customer.loginRegisterForm') }}" class="text-decoration-none">وارد بشوید</a>.
                                                            </section>
                                                        </section>
                                                    </section>
                                                @endguest

                                            </section>
                                        </section>
                                    </section>
                                </section>

                                @if(!empty($comments))

                                    @forelse($comments as $comment)
                                        <section class="product-comment">
                                            <section class="product-comment-header d-flex justify-content-start">
                                                <section class="product-comment-date">{{ convertEnglishToPersian(jalaliDate($comment->created_at,'%d %B، %Y')) }}</section>
                                                <section class="product-comment-title">{{ $comment->user->fullname }}</section>
                                            </section>
                                            <section class="product-comment-body">
                                                {{ $comment->body }}
                                            </section>

                                            @forelse($comment->answers as $answer)
                                                <section class="product-comment px-5 bg-light border">
                                                    <section class="product-comment-header d-flex justify-content-start">
                                                        <section class="product-comment-date">{{ convertEnglishToPersian(jalaliDate($answer->created_at,'%d %B، %Y')) }}</section>
                                                        <section class="product-comment-title">{{ $comment->user->fullname }}</section>
                                                    </section>
                                                    <section class="product-comment-body">
                                                        {{ $answer->body }}
                                                    </section>
                                                </section>

                                            @empty @endforelse

                                        </section>

                                    @empty @endforelse
                                @endif

                            </section>

                        </section>
                    </section>

                </section>
            </section>
        </section>
    </section>
    <!-- end description, features and comments -->

    <!-- toast -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed p-4 flex-row-reverse" style="z-index: 1000; left: 0; top: 3rem; width: 26rem; max-width: 80%">
        <div class="toast shadow-sm" style="position: absolute; top: 0; right: 0;" data-delay="10000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header d-flex justify-content-between">
                <img src="{{ asset('customer-assets/assets/images/logo/8.png') }}" class="rounded mr-2" alt="فروشگاه آمازون">
                <strong class="mr-auto">فروشگاه آمازون</strong>
                <small>{{ jalaliDate('now - 1 minutes', true) }}</small>
                <button type="button" class="btn btn-sm ml-2 mb-1 close border-none rounded-lg" data-dismiss="toast" aria-label="Close">
                    <strong aria-hidden="true">&times;</strong>
                </button>
            </div>
            <div class="toast-body d-flex justify-content-between">
                <span>  برای افزودن کالا به علاقه مندی باید ابتدا وارد حساب کاربری خود شوید</span>
                <a href="{{ route('auth.customer.loginRegisterForm') }}" class="text-danger text-decoration-none fw-bold">ورورد / ثبت نام</a>
            </div>
        </div>
    </div>

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
            $('.product-add-to-compare > button').click(function () {
                var url = $(this).attr('data-url');
                var element = $(this);
                var elementChildren = $('.product-add-to-compare > button[data-url="' + url + '"]').children();

                $.ajax({
                    url: url,
                    success: function (result) {
                        if (result.status === 1) {
                            $(elementChildren).addClass('text-danger');
                            $(element).attr('data-bs-original-title', 'اضافه به مقایسه');
                        } else if (result.status === 2) {
                            $(elementChildren).removeClass('text-danger');
                            $(element).attr('data-bs-original-title', 'افزودن به مقایسه');
                        } else if (result.status === 3) {
                            $('.toast').toast('show')
                        }
                    }
                });
            })
        })
    </script>

    <script>
        $(document).ready(function () {
            bill();

            // input change color
            $('input[name="color"]').change(function () {
                bill();
            });

            // selected guaranty
            $('select[name="guaranty"]').change(function () {
                bill();
            });

            // product number change
            $('.cart-number').click(function () {
                bill();
            });
        })


        function bill() {
            // if color has chosen
            if ($('input[name="color"]:checked').length !== 0) {
                var selectedColor = $('input[name="color"]:checked');
                $('#selected_color_name').html(selectedColor.attr('data-color-name'));
            }

            var selectedColorPrice = 0;
            var selectedGuarantyPrice = 0;
            var number = 1;
            var productDiscountPrice = 0;
            var productOriginalPrice = parseFloat($('#product_price').attr('data-product-original-price'));

            // price increase depending on the choice of color
            if ($('input[name="color"]:checked').length !== 0) {
                selectedColorPrice = parseFloat(selectedColor.attr('data-color-price'));
            }

            // price increase depending on the choice of guaranty
            if ($('#guaranty option:selected').length !== 0) {
                selectedGuarantyPrice = parseFloat($('#guaranty option:selected').attr('data-guaranty-price'));
            }

            // price increase depending on the choice of number of products
            if ($('#number').val() > 0) {
                number = parseFloat($('#number').val());
            }

            // price change depending on discounts
            if ($('#product_discount_price').length !== 0) {
                productDiscountPrice = parseFloat($('#product_discount_price').attr('data-product-discount-price'));
                var priceDecreasePercentage = 100 - productDiscountPrice
            }

            // final price
            var productPrice = (productOriginalPrice * priceDecreasePercentage) / 100;
            productPrice += (selectedColorPrice + selectedGuarantyPrice);
            var finalPrice = (number * productPrice) - productDiscountPrice;

            // $('#product_price').html(productPrice);
            $('#final_price').html(toFarsiNumber(finalPrice) + ' تومان ');
        }
    </script>
    <script>

        //start product introduction, features and comment
        $(document).ready(function () {
            var s = $("#introduction-features-comments");
            var pos = s.position();
            $(window).scroll(function () {
                var windowpos = $(window).scrollTop();

                if (windowpos >= pos.top) {
                    s.addClass("stick");
                } else {
                    s.removeClass("stick");
                }
            });
        });
        //end product introduction, features and comment

    </script>
@endsection
