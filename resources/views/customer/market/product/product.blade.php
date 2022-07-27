@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>{{ $product->name }}</title>
@endsection
@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
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

                    <section class="row mt-4">
                        <!-- start image gallery -->
                        <section class="col-md-4">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <section class="product-gallery">

                                    <section class="product-gallery-selected-image mb-3">
                                        <img src="{{ asset($productImages->first()['indexArray']['medium']) }}" alt="">
                                    </section>
                                    <section class="product-gallery-thumbs">
                                        @foreach ($productImages as $key => $gallery)
                                            <img class="product-gallery-thumb" src="{{ asset($gallery['indexArray']['medium']) }}" alt="{{ $product->name . '-' . ($key + 1) }}" data-input="{{ asset($gallery['indexArray']['medium']) }}">
                                        @endforeach
                                    </section>

                                </section>
                            </section>
                        </section>
                        <!-- end image gallery -->

                        <!-- start product info -->
                        <section class="col-md-5">

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
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
                                            @foreach ($productColors as $key => $color)
                                                <label for="{{ "color_$color->id" }}" style="background-color: {{ $color->color ?? '#fff' }};" class="product-info-colors me-1 border border-4 border-light p-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title={{ $color->color_name }}></label>
                                                <input type="radio" name="color" id="{{ "color_$color->id" }}" class="d-none" value="{{ $color->id }}" data-color-name="{{ $color->color_name }}" data-color-price="{{ $color->price_increase }}" @checked($key === 0)>
                                            @endforeach
                                        </p>
                                    @endif

                                    @if (count($productGuaranties) != 0)
                                        <p>
                                            <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                            گارانتی :
                                            <select name="guaranty" id="guaranty" class="p-1 border rounded-pill">
                                                @foreach ($productGuaranties as $key => $guaranty)
                                                    <option value="{{ $guaranty->id }}" data-guaranty-price="{{ $guaranty->price_increase }}" @selected($key === 0)>{{ $guaranty->name }}</option>
                                                @endforeach

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

                                    <p>
                                        <a class="btn btn-light  btn-sm text-decoration-none" href="#"><i class="fa fa-heart text-danger"></i> افزودن به علاقه مندی</a>
                                    </p>

                                    <section>
                                        <section class="cart-product-number d-inline-block ">
                                            <button class="cart-number cart-number-down" type="button">-</button>
                                            <input type="number" id="number" name="number" min="1" max="5" step="1" value="1" readonly="readonly">
                                            <button class="cart-number cart-number-up" type="button">+</button>
                                        </section>
                                    </section>

                                    <p class="mb-3 mt-5">
                                        <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این
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
                                @endif



                                @if (!empty($amazingSale))
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالا</p>
                                        <p class="text-light badge bg-danger rounded-pill" id="product_discount_price" data-product-discount-price="{{ $amazingSale->percentage }}">{{ convertEnglishToPersian($amazingSale->percentage) }}٪</p>
                                    </section>

                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-end align-items-center">
                                        <p class="fw-bolder" id="final_price">{{ priceFormat($product->price - $amazingSaleProductPrice) }}</p>
                                    </section>

                                    <section class="">
                                        <a id="next-level" href="#" class="btn btn-danger d-block">افزودن به سبد</a>
                                    </section>
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
                        <!-- start vontent header -->
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
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach ($relatedProducts as $relatedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                </section>
                                                <section class="product-add-to-favorite">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a>
                                                </section>
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
                                                            $amazingSaleProductPrice = ($relatedProduct->price * $amazingSale->percentage) / 100;
                                                        @endphp
                                                        <section class="product-price-wrapper">
                                                            <section class="product-discount">
                                                                <span class="product-old-price text-decoration-line-through">{{ priceFormat($relatedProduct->price) }} </span>
                                                                <span class="product-discount-amount">{{ convertEnglishToPersian($relatedProduct->activeAmazingSales()->percentage) }}٪</span>
                                                            </section>
                                                            <section class="product-price">{{ priceFormat($relatedProduct->price - $amazingSaleProductPrice) }}</section>
                                                        </section>
                                                    @else
                                                        <section class="product-price-wrapper">
                                                            <section class="product-price">{{ priceFormat($relatedProduct->price) }}</section>
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

                            <!-- start vontent header -->
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

                            <!-- start vontent header -->
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
                                    @foreach($product->values as $value)
                                        <tr class="border-2">
                                            <td>{{ $value->attribute->name }}</td>
                                            <td>{{ json_decode($value->value)->value }} {{ $value->attribute->unit }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($product->metas as $meta)
                                        <tr class="border-2">
                                            <td>{{ $meta->meta_key }}</td>
                                            <td>{{ $meta->meta_value }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </section>

                            <!-- start vontent header -->
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        دیدگاه ها </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-comments mb-4">

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
                                                        <form class="row" action="{{ route('customer.market.add-comment', $product) }}" method="post">
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

                                    @foreach($comments as $comment)
                                        <section class="product-comment">
                                            <section class="product-comment-header d-flex justify-content-start">
                                                <section class="product-comment-date">{{ convertEnglishToPersian(jalaliDate($comment->created_at,'%d %B، %Y')) }}</section>
                                                <section class="product-comment-title">{{ $comment->user->fullname }}</section>
                                            </section>
                                            <section class="product-comment-body">
                                                {{ $comment->body }}
                                            </section>

                                            @foreach($comment->answers as $answer)
                                                <section class="product-comment px-5 bg-light border">
                                                    <section class="product-comment-header d-flex justify-content-start">
                                                        <section class="product-comment-date">{{ convertEnglishToPersian(jalaliDate($answer->created_at,'%d %B، %Y')) }}</section>
                                                        <section class="product-comment-title">{{ $comment->user->fullname }}</section>
                                                    </section>
                                                    <section class="product-comment-body">
                                                        {{ $answer->body }}
                                                    </section>
                                                </section>

                                            @endforeach

                                        </section>

                                    @endforeach
                                @endif

                            </section>

                        </section>
                    </section>

                </section>
            </section>
        </section>
    </section>
    <!-- end description, features and comments -->

@endsection
@section('script')
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

        function toFarsiNumber(number) {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

            // add comma
            number = new Intl.NumberFormat().format(number);

            // convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }
    </script>

@endsection