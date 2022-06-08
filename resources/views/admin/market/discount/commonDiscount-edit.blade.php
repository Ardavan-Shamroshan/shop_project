@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش تخفیف عمومی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.discount.commonDiscount') }}"> تخفیف های عمومی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تخفیف عمومی جدید</li>
        </ol>
    </nav>
    <section class="main-body-container pb-5">
        <section class="main-body-container-header"><h4>ویرایش تخفیف عمومی جدید</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.discount.commonDiscount') }}" class="btn btn-info btn-sm border rounded-pill btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.market.discount.commonDiscount.update', $commonDiscount->id) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                @method('put')
                <section class="row">
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="percentage" class="font-weight-bold">درصد تخفیف</label>
                            @error('percentage')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('percentage') border border-danger @enderror" name="percentage" id="percentage" value="{{ old('percentage', $commonDiscount->percentage) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="">تاریخ شروع</label>
                            @error('start_date')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                            <input type="text" name="start_date" id="start_date" class="form-control form-control-sm d-none">
                            <input type="text" id="start_date_view" class="form-control form-control-sm @error('start_date') border border-danger @enderror">
                        </div>
                    </section>
                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="">تاریخ پایان</label>
                            @error('end_date')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                            <input type="text" name="end_date" id="end_date" class="form-control form-control-sm d-none">
                            <input type="text" id="end_date_view" class="form-control form-control-sm @error('end_date') border border-danger @enderror">
                        </div>
                    </section>


                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="discount_selling" class="font-weight-bold">سقف تخفیف</label>
                            @error('discount_selling')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('discount_selling') border border-danger @enderror" name="discount_selling" id="discount_selling" value="{{ old('discount_selling', $commonDiscount->discount_selling) }}">
                        </div>
                    </section>



                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="minimal_order_amount" class="font-weight-bold">حداقل مبلغ خرید</label>
                            @error('minimal_order_amount')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('minimal_order_amount') border border-danger @enderror" name="minimal_order_amount" id="minimal_order_amount" value="{{ old('minimal_order_amount', $commonDiscount->minimal_order_amount) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">عنوان مناسبت</label>
                            @error('title')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('title') border border-danger @enderror" name="title" id="title" value="{{ old('title', $commonDiscount->title) }}">
                        </div>
                    </section>




                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="status" class="font-weight-bold">وضعیت</label>
                            @error('status')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="status" id="status" class="form-control form-control-sm @error('status') border border-danger @enderror">
                                <option value="0" @if(old('status') == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>


                    <section class="col-12 col-md-12">
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
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date'
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date'
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
@endsection
