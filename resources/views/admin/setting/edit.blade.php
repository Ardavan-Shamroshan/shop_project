@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش تنظیمات</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="#">بخش تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.setting') }}">تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تنظیمات</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>ویرایش تنظیمات</h4>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.setting') }}" class="btn btn-info  rounded-pill btn-hover color-8">« بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.setting.update', $setting->id) }}" method="post" enctype="multipart/form-data" id="form">
                        @csrf
                        {{ method_field('put') }}
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">عنوان سایت</label>
                                    @error('title')
                                    <span class="alert_required p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" class="form-control form-control-sm" name="title" id="name" value="{{ old('title', $setting->title) }}">
                                </div>
                            </section>

                            <section class="col-md-3">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">کلمات کلیدی سایت</label>
                                    @error('keywords')
                                    <span class="alert_required p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" class="form-control form-control-sm" name="keywords" id="name" value="{{ old('keywords', $setting->keywords) }}">
                                </div>
                            </section>

                            <section class="col-md-3">
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">ایمیل سایت</label>
                                    @error('email')
                                    <span class="alert_required p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" class="form-control form-control-sm" name="email" id="email" value="{{ old('email', $setting->email) }}" placeholder="مثال : example@email.com">
                                </div>
                            </section>

                            <section class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile" class="font-weight-bold">تلفن همراه</label>
                                    @error('mobile')
                                    <span class="alert_required p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="number" class="form-control form-control-sm" name="mobile" id="mobile" value="{{ old('mobile', $setting->mobile) }}" placeholder="مثال : 12345678912">
                                </div>
                            </section>

                            <section class="col-md-8">
                                <div class="form-group">
                                    <label for="phone2" class="font-weight-bold">آدرس</label>
                                    @error('address')
                                    <span class="alert_required p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" class="form-control form-control-sm" name="address" id="address" value="{{ old('address', $setting->address) }}">
                                </div>
                            </section>

                            <section class="col-md-3">
                                <div class="form-group">
                                    <label for="phone1" class="font-weight-bold">تلفن 1</label>
                                    @error('phone1')
                                    <span class="alert_required p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" class="form-control form-control-sm" name="phone1" id="phone1" value="{{ old('phone1', $setting->phone1) }}" placeholder="مثال : 061 - 12345678">
                                </div>
                            </section>

                            <section class="col-md-3">
                                <div class="form-group">
                                    <label for="phone2" class="font-weight-bold">تلفن 2</label>
                                    @error('phone2')
                                    <span class="alert_required p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" class="form-control form-control-sm" name="phone2" id="phone2" value="{{ old('phone2', $setting->phone2) }}" placeholder="مثال : 061 - 12345678">
                                </div>
                            </section>

                            <section class="col-md-6">
                                <div class="form-group">
                                    <label for="phone2" class="font-weight-bold">کپی رایت</label>
                                    @error('copyright')
                                    <span class="alert_required p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="text" class="form-control form-control-sm" name="copyright" id="copyright" value="{{ old('copyright', $setting->copyright) }}">
                                </div>
                            </section>


                            <section class="col-md-6">
                                <div class="form-group">
                                    <label for="description_body" class="font-weight-bold" class="font-weight-bold">توضیحات</label>
                                    @error('description')
                                    <span class="alert_required text-danger" role="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                                    @enderror
                                    <textarea type="text" class="form-control form-control-sm @error('description') border border-danger @enderror" name="description" id="description_body" rows="6"> {{ old('description', $setting->description) }} </textarea>
                                </div>
                            </section>


                            <section class="col-md-3">
                                <div class="form-group">
                                    <label for="image" class="font-weight-bold">لوگو</label>
                                    @error('logo')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="file" class="form-control form-control-sm" name="logo" id="image">
                                </div>
                                <section>
                                    <div class="form-check pl-0 py-2 border border-gray rounded text-capitalize text-center shadow-sm">
                                        <label for="" class="form-check-label mx-2 font-weight-bold">
                                            <img src="{{ asset($setting->logo)}}" class="w-100 border rounded" alt="عکس">
                                        </label>
                                        <hr>
                                        <span class="font-weight-bold">لوگو</span>
                                    </div>
                                </section>
                            </section>

                            <section class="col-md-3">
                                <div class="form-group">
                                    <label for="icon" class="font-weight-bold">آیکون</label>
                                    @error('icon')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </span>
                                    @enderror
                                    <input type="file" class="form-control form-control-sm" name="icon" id="icon">
                                </div>
                                <section class="">
                                    <div class="form-check pl-0 py-2 border border-gray rounded text-capitalize text-center shadow-sm">
                                        <label for="" class="form-check-label mx-2 font-weight-bold">
                                            <img src="{{ asset($setting->icon)}}" class="w-100 border rounded" alt="عکس">
                                        </label>
                                        <hr>
                                        <span class="font-weight-bold">آیکون</span>
                                    </div>
                                </section>
                            </section>



                            <section class="col-12">
                                <button class="btn btn-primary btn-hover color-9 rounded-pill">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection
