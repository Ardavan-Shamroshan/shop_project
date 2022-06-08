@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد رنگ </title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">

@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.product') }}">کالا ها</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.product.color', $product->id) }}">رنگ کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد رنگ جدید</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ایجاد رنگ </h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.product.color', $product->id) }}" class="btn btn-info btn-sm border rounded-pill btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.market.product.color.store', $product->id) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <section class="row">
                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="color_name" class="font-weight-bold">نام رنگ </label>
                            @error('color_name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('color_name') border border-danger @enderror" name="color_name" id="color_name" value="{{ old('color_name') }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="color">رنگ</label>
                            <input type="color" name="color" value="{{ old('color') }}" class="form-control form-control-sm form-control-color">
                        </div>
                        @error('color')
                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </section>

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="price_increase" class="font-weight-bold">افزایش قیمت </label>
                            @error('price_increase')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('price_increase') border border-danger @enderror" name="price_increase" id="price_increase" value="{{ old('price_increase') }}">
                        </div>
                    </section>

                    <section class="col-12">
                        <button class="btn btn-primary border rounded-pill btn-hover color-9">ثبت</button>
                    </section>
                </section>
            </form>
        </section>
    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('description_body')
    </script>
    <script>
        $(document).ready(function () {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at'
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0)
                default_data = default_tags.split(',');

            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');
            $('#form').submit(function () {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
    <script>
        $(function () {
            $('#btn-copy').on('click', function () {
                var element = $(this).parent().prev().clone(true);
                $(this).before(element);
            })
        });
    </script>
@endsection
