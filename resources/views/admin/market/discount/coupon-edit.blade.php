@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش کوپن تخفیف</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.discount.coupon') }}"> کوپن های تخفیف</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کوپن تخفیف جدید</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش کوپن تخفیف جدید</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.discount.coupon') }}" class="btn btn-info btn-sm border rounded-pill btn-sm btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.market.discount.coupon.update', $coupon->id) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                @method('put')
                <section class="row">
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="code" class="font-weight-bold">کد تخفیف</label>
                            @error('code')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('code') border border-danger @enderror" name="code" id="code" value="{{ old('code', $coupon->code) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="">تاریخ شروع</label>
                            @error('start_date')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" name="start_date" id="start_date" class="form-control form-control-sm d-none" value="{{ old('start_date', $coupon->start_date) }}">
                            <input type="text" id="start_date_view" class="form-control form-control-sm @error('start_date') border border-danger @enderror" value="{{ old('start_date', $coupon->start_date) }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="">تاریخ پایان</label>
                            @error('end_date')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" name="end_date" id="end_date" class="form-control form-control-sm d-none" value="{{ old('end_date', $coupon->end_date) }}">
                            <input type="text" id="end_date_view" class="form-control form-control-sm @error('end_date') border border-danger @enderror" value="{{ old('end_date', $coupon->end_date) }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="type" class="font-weight-bold">نوع کوپن</label>
                            @error('type')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="type" id="type" class="form-control form-control-sm @error('type') border border-danger @enderror">
                                <option value="0" @if(old('type', $coupon->type) == 0) selected @endif>عمومی</option>
                                <option value="1" @if(old('type', $coupon->type) == 1) selected @endif>خصوصی</option>
                            </select>
                        </div>
                    </section>
                    <section class="col-12 col-md-6" id="users" hidden>
                        <div class="form-group">
                            <label for="user_id" class="font-weight-bold">کاربران</label>
                            @error('user_id')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="user_id" id="user_id" class="form-control form-control-sm  @error('user_id') border border-danger @enderror" disabled>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if(old('user_id', $coupon->user_id) == $user->id) selected @endif>{{ $user->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="amount" class="font-weight-bold">میزان</label>
                            @error('amount')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('amount') border border-danger @enderror" name="amount" id="amount" value="{{ old('amount', $coupon->amount) }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="discount_ceiling" class="font-weight-bold">سقف تخفیف</label>
                            @error('discount_ceiling')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('discount_ceiling') border border-danger @enderror" name="discount_ceiling" id="discount_ceiling" value="{{ old('discount_ceiling', $coupon->discount_ceiling) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="amount_type" class="font-weight-bold">نوع تخفیف</label>
                            @error('amount_type')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="amount_type" id="amount_type" class="form-control form-control-sm @error('amount_type') border border-danger @enderror">
                                <option value="0" @if(old('amount_type', $coupon->amount_type) == 0) selected @endif>درصدی</option>
                                <option value="1" @if(old('amount_type', $coupon->amount_type) == 1) selected @endif>تومان</option>
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
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
                                <option value="0" @if(old('status', $coupon->status) == 0) selected @endif>غیرفعال</option>
                                <option value="1" @if(old('status', $coupon->status) == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-12">
                        <button class="btn btn-primary border rounded-pill btn-sm btn-hover color-9">ثبت</button>
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
        if ($('#type').find(':selected').val() === '1') {
            $('#user_id').removeAttr('disabled');
            $('#users').removeAttr('hidden');
        }
        $('#type').change(function () {
            if ($('#type').find(':selected').val() === '1') {
                $('#user_id').removeAttr('disabled');
                $('#users').fadeIn(500).removeAttr('hidden');
            } else {
                $('#user_id').attr('disabled');
                $('#users').fadeOut(300).attr('hidden');
            }
        });
    </script>
@endsection
