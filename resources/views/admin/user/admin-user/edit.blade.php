@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش کاربر ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.user.admin-user') }}">کاربر ادمین</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کاربر ادمین</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش کاربر ادمین</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.admin-user') }}" class="btn btn-info btn-sm btn-hover color-8 rounded-lg">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.user.admin-user.update', $admin->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <section class="row">
                    <input type="hidden" value="{{ $admin->id }}" name="id">
                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">نام</label>
                            @error('first_name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('first_name') border border-danger @enderror" name="first_name" value="{{ old('first_name', $admin->first_name) }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">نام خانوادگی</label>
                            @error('last_name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('last_name') border border-danger @enderror" name="last_name" value="{{ old('last_name', $admin->last_name) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">کد ملی</label>
                            @error('national_code')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('national_code') border border-danger @enderror" name="national_code" value="{{ old('national_code', $admin->national_code) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">تصویر</label>
                            @error('profile_photo_path')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="file" class="form-control form-control-sm @error('profile_photo_path') border border-danger @enderror" name="profile_photo_path">
                        </div>
                    </section>

                    <section class="col-md-6">
                        <label for="" class="form-check-label mx-2 font-weight-bold">
                            <img src="{{ asset($admin->profile_photo_path)}}" class="border p-1 shadow-sm rounded-circle" alt="عکس" width="200" height="200">
                        </label>
                    </section>

                    <section class="col-12 col-md-6">
                        <button class="btn btn-primary btn-hover color-9 rounded-lg">ثبت</button>
                    </section>


                </section>
            </form>
        </section>
    </section>
@endsection
@section('script')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const passwordConfirm = document.querySelector('#password_confirmation');

        togglePassword.addEventListener('click', function () {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordConfirm.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection