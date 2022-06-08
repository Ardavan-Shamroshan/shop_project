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
            <a href="{{ route('admin.market.storeroom') }}" class="btn btn-info btn-sm border rounded-pill btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.market.storeroom.store', $product->id) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <section class="row">
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="receiver" class="font-weight-bold">نام تحویل گیرنده</label>
                            @error('receiver')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('receiver') border border-danger @enderror" name="receiver" id="receiver" value="{{ old('receiver') }}">
                        </div>

                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="deliverer" class="font-weight-bold">نام تحویل دهنده</label>
                            @error('deliverer')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('deliverer') border border-danger @enderror" name="deliverer" id="deliverer" value="{{ old('deliverer') }}">
                        </div>

                    </section>

                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="marketable_number" class="font-weight-bold">تعداد</label>
                            @error('marketable_number')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('marketable_number') border border-danger @enderror" name="marketable_number" id="marketable_number" value="{{ old('marketable_number') }}">
                        </div>
                        <section>
                            <button class="btn btn-primary border rounded-pill btn-hover color-9">ثبت</button>
                        </section>
                    </section>
                    <section class="col-12 col-md-9">
                        <div class="form-group">
                            <label for="description_body" class="font-weight-bold">توضیحات</label>
                            @error('description')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <textarea type="text" class="form-control form-control-sm @error('description') border border-danger @enderror" name="description" rows="5"> {{ old('description') }} </textarea>
                        </div>
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
