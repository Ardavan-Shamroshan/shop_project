@extends('customer.layouts.master-twin-col')
@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">

                @include('customer.layouts.partials.products-sidebar')

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <section class="filters mb-3">
                            @if(request()->filled('search'))
                                <span class="d-inline-block border p-1 rounded bg-light">نتیجه جستجو برای : <span class="badge bg-info text-dark">"{{ request()->search }}"</span></span>
                            @endif
                            @if(request()->filled('brands'))
                                <span class="d-inline-block border p-1 rounded bg-light">برند : <span class="badge bg-info text-dark">"{{ $selectedBrands->implode('persian_name',',') }}"</span></span>
                            @endif
                            @if(request()->filled('category'))
                                <span class="d-inline-block border p-1 rounded bg-light">دسته : <span class="badge bg-info text-dark">"کتاب"</span></span>
                            @endif
                            @if(request()->filled('min_price'))
                                <span class="d-inline-block border p-1 rounded bg-light">قیمت از : <span class="badge bg-info text-dark">{{ priceFormat(request()->min_price) }}</span></span>
                            @endif
                            @if(request()->filled('max_price'))
                                <span class="d-inline-block border p-1 rounded bg-light">قیمت تا : <span class="badge bg-info text-dark">{{ priceFormat(request()->max_price) }}</span></span>
                            @endif

                            @if(request()->hasAny(['search', 'sort', 'brands', 'category', 'min_price', 'max_price']))
                                <a href="{{ route('customer.products') }}" class="btn btn-outline-danger btn-sm rounded"><span><i class="fa fa-trash-alt"></i></span></a>
                            @endif
                        </section>
                        <section class="sort ">
                            <span>مرتب سازی بر اساس : </span>
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 1, 'btn-light' => request()->sort != 1])>جدیدترین</a>
                            {{-- <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '2']) }}" @class("btn btn-light btn-sm px-1 py-0)">محبوب ترین</a>--}}
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '2', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 2, 'btn-light' => request()->sort != 2])>گران
                                ترین</a>
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '3', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 3 ,'btn-light' => request()->sort != 3])>ارزان
                                ترین</a>
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '4', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 4,'btn-light' => request()->sort != 4])>پربازدیدترین</a>
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '5', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => request()->category]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 5,'btn-light' => request()->sort != 5])>پرفروش
                                ترین</a>
                        </section>


                        <section class="main-product-wrapper row my-4">


                            @forelse ($products as $product)
                                <section class="col-md-3 p-0">
                                    <section class="product">
                                        <section class="product-add-to-cart"><a href="{{ route('customer.market.product', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i
                                                        class="fa fa-cart-plus"></i></a></section>
                                        <section class="product-add-to-favorite"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i
                                                        class="fa fa-heart"></i></a></section>
                                        <a class="product-link" href="{{ route('customer.market.product', $product) }}">
                                            <section class="product-image">
                                                <img src="{{ asset($product->image['indexArray']['medium']) }}" alt="">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name">
                                                <h3>{{ $product->name }}</h3>
                                            </section>
                                            <section class="product-price-wrapper">
                                                <section class="product-discount">
                                                    @if(!empty($product->activeAmazingSales()))
                                                        <span class="product-old-price">{{ priceFormat($product->price) }} </span>
                                                        <span class="product-discount-amount">{{ discountFormat($product->activeAmazingSales()->percentage) }}</span>
                                                    @endif
                                                </section>
                                                @php
                                                    $amazingSale = $product->activeAmazingSales();
                                                        if (!empty($amazingSale))
                                                            $amazingSaleProductPrice = ($product->price * $amazingSale->percentage) / 100;
                                                        else
                                                            $amazingSaleProductPrice = 0;
                                                @endphp
                                                <section class="product-price content-header-title">{{ priceFormat($product->price - $amazingSaleProductPrice) }}</section>
                                                <section class="product-colors">
                                                    @forelse($product->colors as $productColor)
                                                        <section class="product-colors-item" style="background-color: {{ $productColor->color }};"></section>
                                                    @empty
                                                    @endforelse
                                                </section>
                                            </section>

                                        </a>
                                    </section>
                                </section>
                            @empty
                                <h1 class="text-danger">محصولی یافت نشد</h1>
                            @endforelse


                            {{ $products->links('pagination::bootstrap-5') }}

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
@section('script')
    <script>
        $('.product-add-to-favorite button').click(function () {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function (result) {
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger')
                        $(element).attr('data-original-title', 'افزودن از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی ها');
                    } else if (result.status == 3) {
                        $('.toast').toast('show');
                    }
                }
            })
        })
    </script>
@endsection
