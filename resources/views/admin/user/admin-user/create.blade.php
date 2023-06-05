@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد کاربر ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.user.admin-user') }}">کاربر ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر ادمین</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ایجاد کاربر ادمین</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.admin-user') }}" class="btn btn-info  btn-hover color-8 rounded-lg">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.user.admin-user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <section class="row">
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">نام</label>
                            @error('first_name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('first_name') border border-danger @enderror" name="first_name" value="{{ old('first_name') }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">نام خانوادگی</label>
                            @error('last_name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('last_name') border border-danger @enderror" name="last_name" value="{{ old('last_name') }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">ایمیل</label>
                            @error('email')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="email" class="form-control form-control-sm @error('email') border border-danger @enderror" name="email" value="{{ old('email') }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">شماره موبایل</label>
                            @error('mobile')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="number" class="form-control form-control-sm @error('mobile') border border-danger @enderror" name="mobile" value="{{ old('mobile') }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold"> کلمه عبور</label>
                            @error('password')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <div class="position-relative">
                            <input type="password" class="form-control form-control-sm @error('password') border border-danger @enderror" name="password" id="password">
                                <i class="far fa-eye float-left mt-n4 ml-3 pointer text-muted" id="togglePassword"></i>
                            </div>

                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="font-weight-bold">تکرار کلمه عبور</label>
                            @error('password_confirmation')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="password" class="form-control form-control-sm @error('password_confirmation') border border-danger @enderror" name="password_confirmation" id="password_confirmation">
                            <i class="float-left mt-n4 ml-3 pointer text-muted" id="togglePassword"></i>
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
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="activation" class="font-weight-bold">فعال سازی حساب کاربری</label>
                            @error('activation')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="activation" id="activation" class="form-control form-control-sm @error('activation') border border-danger @enderror">
                                <option value="0" @if(old('activation') == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('activation') == 1) selected @endif>فعال</option>
                            </select>
                        </div>
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