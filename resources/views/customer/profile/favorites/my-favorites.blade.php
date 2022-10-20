@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>لیست علاقه مندی های شما </title>
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
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>لیست علاقه های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->

                        @forelse(auth()->user()->products as $product)
                            <section class="cart-item d-flex py-3">
                                <section class="cart-img align-self-start flex-shrink-1">
                                    <img src="{{ asset($product->image['indexArray']['medium']) }}" alt=""></section>
                                <section class="align-self-start w-100">
                                    <p class="fw-bold">{{ $product->name }}</p>
                                    @foreach($product->colors as $color)
                                        <p>
                                            <span style="background-color: {{ $color->color }};" class="cart-product-selected-color me-1"></span>
                                            {{ $color->color_name }}</p>
                                    @endforeach

                                    @if ($product->marketable_number > 0)
                                        <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                            <span>کالا موجود در انبار</span></p>
                                    @else
                                        <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                            <span>کالا ناموجود</span></p>
                                    @endif
                                    <section>
                                        <a class="text-decoration-none cart-delete" href="{{ route('customer.profile.my-favorites.remove', $product) }}"><i class="fa fa-trash-alt"></i> حذف از لیست علاقه ها</a>
                                    </section>
                                </section>
                                <section class="align-self-end flex-shrink-1">
                                    @if(empty($product->activeAmazingSales()))
                                        <section class="text-nowrap fw-bold"> {{ priceFormat($product->price) }}</section>
                                    @else
                                        @php
                                            $amazingSaleProductPrice = ($product->price * $product->activeAmazingSales()->percentage) / 100;
                                        @endphp
                                        <section class="cart-item-discount text-danger text-nowrap mb-1"> {{ discountFormat($product->activeAmazingSales()->percentage) }} تخفیف</section>
                                        <span class="product-old-price text-decoration-line-through">{{ priceFormat($product->price) }} </span>
                                        <section class="text-nowrap fw-bold"> {{ priceFormat($product->price - $amazingSaleProductPrice) }}</section>

                                    @endif

                                </section>
                            </section>

                        @empty
                            <section class="order-item">
                                <section class="flex justify-content-between">
                                    <p>محصولی به لیست علاقه مندی های خود اضافه نکرده اید</p>
                                </section>
                            </section>
                        @endforelse

                    </section>
                </main>
            </section>
        </section>
    </section>

@endsection
