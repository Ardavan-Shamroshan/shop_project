@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>لیست مقایسه های شما </title>
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
                                    <span>لیست مقایسه های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->


                        @if(auth()->user()->products()->isNotEmpty())
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>عکس محصول</td>
                                    @forelse(auth()->user()->compare->products  as $product)
                                        <td>
                                            <img src="{{ asset($product->image['indexArray']['medium']) }}" width="100">
                                        </td>
                                    @empty @endforelse
                                </tr>
                                <tr>
                                    <td>قیمت محصول</td>
                                    @forelse(auth()->user()->compare->products  as $product)
                                        <td>
                                            {{ priceFormat($product->price) }}
                                        </td>
                                    @empty @endforelse
                                </tr>
                                <tr>
                                    <td>نام محصول</td>
                                    @forelse(auth()->user()->compare->products  as $product)
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                    @empty @endforelse
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <h2>محصولی برای مقایسه یافت نشد</h2>
                        @endif

                    </section>
                </main>
            </section>
        </section>
    </section>
@endsection
