@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش فایل اطلاعیه ایمیلی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 p-0">
                <a href="{{ route('admin.notify.email-file', $file->email->id) }}">فایل اعلامیه ایمیل</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش فایل اطلاعیه ایمیلی</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش فایل اطلاعیه ایمیلی</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.notify.email-file', $file->email->id) }}" class="btn btn-info  border rounded-pill  btn-hover color-8">« بازگشت</a>
        </section>

        <section>
            <form action="{{ route('admin.notify.email-file.update', $file->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('put') }}
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
                            <input type="file" class="form-control form-control-sm @error('file') border border-danger @enderror" name="file" id="file" value="{{ $file->file_path }}">
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
                                <option value="0" @if(old('status', $file->status) == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('status', $file->status) == 1) selected @endif>فعال</option>
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
                                <option value="public" @if(old('storage_dir', $file->storage_dir) == 'public') selected @endif>عمومی</option>
                                <option value="storage" @if(old('storage_dir', $file->storage_dir) == 'storage') selected @endif>محافظت شده</option>
                            </select>
                        </div>
                    </section>
                    <section class="row">
                        <section class="col-md-12">
                            @if($file->file_type === 'pdf')
                                <section class='col-md-12'>
                                    <a href="{{ asset($file->file_path) }}" class="font-weight-bold">
                                        <div class="d-flex shadow-sm p-1 border text-muted rounded my-1">
                                            <img src="{{ asset('images/icons/pdf.png') }}" alt="" width="50" height="50">
                                            <span class="text-left">{{ $file->file_path }}</span>
                                        </div>
                                    </a>
                                </section>

                            @elseif($file->file_type == 'rar')
                                <section class="col-md-12">
                                    <a href="{{ asset($file->file_path) }}" class="font-weight-bold">
                                        <div class="d-flex shadow-sm p-1 text-muted border rounded my-1">
                                            <img src="{{ asset('images/icons/rar.png') }}" alt="" width="50" height="50">
                                            <span class="text-left">{{ $file->file_path }}</span>
                                        </div>
                                    </a>
                                </section>

                            @elseif($file->file_type == 'zip')
                                <section class="col-md-12">
                                    <a href="{{ asset($file->file_path) }}" class="font-weight-bold">
                                        <div class="d-flex shadow-sm p-1 border text-muted rounded my-1">
                                            <img src="{{ asset('images/icons/zip.png') }}" alt="" width="50" height="50">
                                            <span class="text-left">{{ $file->file_path }}</span>
                                        </div>
                                    </a>
                                </section>


                            @elseif(in_array($file->file_type, ['doc', 'docx']))
                                <section class="col-md-12">
                                    <a href="{{ asset($file->file_path) }}" class="font-weight-bold">
                                        <div class=" d-flex shadow-sm p-1 border text-muted rounded my-1">
                                            <img src="{{ asset('images/icons/doc.png') }}" alt="" width="50" height="50">
                                            <span class="text-left">{{ $file->file_path }}</span>
                                        </div>
                                    </a>
                                </section>

                            @elseif(in_array($file->file_type, ['png','jpg','jpeg','gif']))
                                <section class="col-md-12">
                                    <a href="{{ asset($file->file_path) }}" class="font-weight-bold">
                                        <div class=" d-flex shadow-sm p-1 border text-muted rounded my-1">
                                            <img src="{{ asset('images/icons/image.png') }}" alt="" width="50" height="50">
                                            <span class="text-left">{{ $file->file_path }}</span>
                                        </div>
                                    </a>
                                </section>
                            @endif
                        </section>
                    </section>
                </section>

                <section class="col-12 col-md-6 my-3">
                    <button class="btn btn-primary btn-hover color-9 rounded-pill border">ثبت</button>
                </section>
            </form>
        </section>
    </section>

@endsection

@section('script')
@endsection
