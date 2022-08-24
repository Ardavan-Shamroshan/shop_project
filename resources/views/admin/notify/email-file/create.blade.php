@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد فایل اطلاعیه ایمیلی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.notify.email-file', $email->id) }}">فایل اعلامیه ایمیل</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد فایل اطلاعیه ایمیلی</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ایجاد فایل اطلاعیه ایمیلی</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.notify.email') }}" class="btn btn-info btn-sm border rounded-pill btn-sm btn-hover color-8">« بازگشت</a>
        </section>

        <section>
            <form action="{{ route('admin.notify.email-file.store', $email->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <section class="row">
                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="file" class="font-weight-bold">فایل</label>
                            @error('file')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="file" class="form-control form-control-sm @error('file') border border-danger @enderror" name="file" id="file">
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

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="storage_dir" class="font-weight-bold">نوع ذخیره سازی</label>
                            @error('storage_dir')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="storage_dir" id="storage_dir" class="form-control form-control-sm @error('storage_dir') border border-danger @enderror">
                                <option value="public" @if(old('storage_dir') == 0) selected @endif>عمومی</option>
                                <option value="storage" @if(old('storage_dir') == 1) selected @endif>محافظت شده</option>
                            </select>
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
@endsection
