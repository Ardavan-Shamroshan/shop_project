@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش مقدار فرم کالا</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.property') }}">فرم کالا</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.property.value', $attribute->id) }}">مقدار فرم کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش مقدار فرم کالا</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش مقدار فرم کالا</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.property.value', $attribute->id) }}" class="btn btn-info btn-sm border rounded-pill btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.market.property.value.update', ['attribute' => $attribute->id, 'value' => $value->id]) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                @method('put')
                <section class="row">
                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="product_id" class="font-weight-bold">انتخاب محصول</label>
                            @error('product_id')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="product_id" id="product_id" class="form-control form-control-sm @error('product_id') border border-danger @enderror">
                                <option value="">محصول را انتخاب کنید</option>
                                @foreach($attribute->category->products as $product)
                                    <option value="{{ $product->id }}" @if(old('product_id', $value->product_id) === $product->id) selected @endif>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="value" class="font-weight-bold">مقدار</label>
                            @error('value')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('value') border border-danger @enderror" name="value" id="value" value="{{ old('value', json_decode($value->value)->value) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="price_increase" class="font-weight-bold">افزایش قیمت </label>
                            @error('price_increase')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('price_increase') border border-danger @enderror" name="price_increase" id="price_increase" value="{{ old('price_increase', json_decode($value->value)->price_increase) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="type" class="font-weight-bold">نوع</label>
                            @error('type')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="type" id="type"
                                    class="form-control form-control-sm @error('type') border border-danger @enderror">
                                <option value="0" @if(old('type', $product->type) == 0) selected @endif>ساده</option>
                                <option value="1" @if(old('type', $product->type) == 1) selected @endif>انتخابی</option>
                            </select>
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
    <script>
        CKEDITOR.replace('description_body')
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
@endsection
