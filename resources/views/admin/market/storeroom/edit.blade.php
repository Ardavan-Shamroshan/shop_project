@extends('admin.layouts.master')
@section('head-tag')
    <title>اضافه کردن به انبار</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.storeroom') }}">فرم کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اضافه کردن به انبار</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>اضافه کردن به انبار</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.storeroom') }}" class="btn btn-info  border rounded-pill  btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.market.storeroom.update', $product->id) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                @method('put')
                <section class="row">

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="marketable_number" class="font-weight-bold">تعداد موجودی</label>
                            @error('marketable_number')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('marketable_number') border border-danger @enderror" name="marketable_number" id="marketable_number" value="{{ old('marketable_number', $product->marketable_number) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="frozen_number" class="font-weight-bold">تعداد رزرو شده</label>
                            @error('frozen_number')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('frozen_number') border border-danger @enderror" name="frozen_number" id="frozen_number" value="{{ old('frozen_number', $product->frozen_number) }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="sold_number" class="font-weight-bold">تعداد فروخته شده</label>
                            @error('sold_number')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('sold_number') border border-danger @enderror" name="sold_number" id="sold_number" value="{{ old('sold_number', $product->sold_number) }}">
                        </div>

                    </section>


                    <section class="col-12">
                        <button class="btn btn-primary border rounded-pill  btn-hover color-9">ثبت</button>
                    </section>
                </section>
            </form>
        </section>

    </section>
@endsection
@section('script')
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
@endsection
