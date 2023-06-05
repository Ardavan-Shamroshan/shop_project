@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش اطلاعیه پیامکی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.notify.sms') }}">اعلامیه پیامکی</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش اطلاعیه پیامکی</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش اطلاعیه پیامکی</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.notify.sms') }}" class="btn btn-info  border rounded-pill  btn-hover color-8">« بازگشت</a>
        </section>

        <section>
            <form action="{{ route('admin.notify.sms.update', $sms->id) }}" method="post">
                @csrf
                {{ method_field('put')}}
                <section class="row">
                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">عنوان پیامک</label>
                            @error('title')
                            <span class="alert_required text-danger p-1" role="alert">
                                <small>
                                    {{ $message }}
                                </small>
                            </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm border @error('title') border border-danger @enderror" name="title" value="{{ old('title', $sms->title) }}">
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
                                <option value="0" @if(old('status', $sms->status) == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('status', $sms->status) == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">تاریخ انتشار</label>
                            @error('published_at')
                            <span class="alert_required text-danger p-1" role="alert">
                                <small>
                                    {{ $message }}
                                </small>
                            </span>
                            @enderror
                            <input type="text" name="published_at" id="published_at" class="form-control form-control-sm d-none" value="{{ old('published_at', $sms->published_at) }}">
                            <input type="text" id="published_at_view" class="form-control form-control-sm @error('published_at') border border-danger @enderror" value="{{  old('published_at', $sms->published_at) }}">
                        </div>
                    </section>

                    <section class="col-12">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">متن پیامک</label>
                            @error('body')
                            <span class="alert_required text-danger p-1" role="alert">
                                <small>
                                    {{ $message }}
                                </small>
                            </span>
                            @enderror
                            <textarea name="body" id="sms_body" rows="6" class="form-control form-control-sm @error('body') border border-danger @enderror">{{ old('body', $sms->body) }}</textarea>
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <button class="btn btn-primary btn-hover color-9 rounded-pill border">ثبت</button>
                    </section>
                </section>
            </form>
        </section>
    </section>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
    </script>
@endsection
