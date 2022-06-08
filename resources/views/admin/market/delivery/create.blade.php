@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد روش ارسال</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a
                    href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.delivery') }}">روش ارسال</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد روش ارسال جدید</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ایجاد روش ارسال جدید</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.delivery') }}"
               class="btn btn-info btn-sm border rounded-pill btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.market.delivery.store') }}" method="post" enctype="multipart/form-data"
                  id="form">
                @csrf
                <section class="row">
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">روش ارسال</label>
                            @error('name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text"
                                   class="form-control form-control-sm @error('name') border border-danger @enderror"
                                   name="name" id="name" value="{{ old('name') }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="amount" class="font-weight-bold">هزینه روش ارسال</label>
                            @error('amount')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text"
                                   class="form-control form-control-sm @error('amount') border border-danger @enderror"
                                   name="amount" id="amount" value="{{ old('amount') }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="delivery_time" class="font-weight-bold">زمان ارسال</label>
                            @error('delivery_time')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text"
                                   class="form-control form-control-sm @error('delivery_time') border border-danger @enderror"
                                   name="delivery_time" id="delivery_time" value="{{ old('delivery_time') }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="delivery_time_unit" class="font-weight-bold">واحد زمان ارسال</label>
                            @error('delivery_time_unit')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text"
                                   class="form-control form-control-sm @error('delivery_time_unit') border border-danger @enderror"
                                   name="delivery_time_unit" id="delivery_time_unit"
                                   value="{{ old('delivery_time_unit') }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
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
