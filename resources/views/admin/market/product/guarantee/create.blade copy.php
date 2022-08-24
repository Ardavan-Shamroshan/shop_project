@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد گارانتی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.product') }}">کالا </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد گارانتی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد گارانتی </h5>
                </section>
                <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.guarantee', $product->id) }}"
                       class="btn btn-info btn-sm border rounded-pill btn-sm btn-hover color-8">«
                        بازگشت</a>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4"></section>
                <section>
                    <form action="{{ route('admin.market.product.guarantee.store', $product->id) }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">نام گارانتی</label>
                                    @error('name')
                                    <span class="alert-required text-danger" role="alert">
                                        <small>
                                            <b>{{ $message }}</b>
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm @error('name') border border-danger @enderror">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">افزایش قیمت</label>
                                    @error('price_increase')
                                    <span class="alert-required text-danger" role="alert">
                                        <small>
                                            <b>{{ $message }}</b>
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" name="price_increase" value="{{ old('price_increase') }}" class="form-control form-control-sm @error('price_increase') border border-danger @enderror">
                                </div>
                            </section>

                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary border rounded-pill btn-sm btn-hover color-9">ثبت</button>
                        </section>
                </form>
            </section>

        </section>
    </section>
    </section>

@endsection


@section('script')

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('introduction');
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

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');


            $('#form').submit(function (event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>

    <script>
        $(function () {
            $("#btn-copy").on('click', function () {
                var ele = $(this).parent().prev().clone(true);
                $(this).before(ele);
            })
        })
    </script>

@endsection
