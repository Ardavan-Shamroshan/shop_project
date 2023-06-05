@extends('admin.layouts.master')
@section('head-tag')
    <title>گارانتی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.product') }}">کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> گارانتی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        گارانتی </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.guarantee.create', $product->id) }}" class="btn btn-info  border rounded-lg  btn-hover color-8">ایجاد گارانتی جدید </a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th> گارانتی کالا</th>
                            <th> افزایش قیمت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($product->guarantees as $guarantee)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $guarantee->name }}</td>
                                <td>{{ priceFormat($guarantee->price_increase) }}</td>

                                <td class="width-16-rem text-left">
                                    <form class="d-inline" action="{{ route('admin.market.product.guarantee.destroy', ['product' => $product->id , 'guarantee' => $guarantee->id] ) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger  delete border rounded-lg  btn-hover color-11">
                                            <i class="fa fa-times rounded-lg"></i> حذف
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        @empty @endforelse

                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection


@section('script')

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
