@extends('customer.layouts.master-simple')

@section('content')

    <section class="vh-100 d-flex justify-content-center align-items-center pb-5 mt-5">
        <form action="{{ route('auth.customer.loginRegister') }}" method="post">
            @csrf
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img src="{{ asset('customer-assets/assets/images/logo/4.png') }}" class="p-2 rounded bg-light shadow-sm" alt="login-logo">
                </section>
                <section class="login-title">ورود / ثبت نام</section>
                <section class="login-info">شماره موبایل یا پست الکترونیک خود را وارد کنید</section>
                <section class="login-input-text">
                    @error('id')
                    <span class="alert_required text-danger" role="alert">
                            <small class="font-weight-bold font-size-12">{{ $message }}</small>
                    </span>
                    @enderror
                    <input type="text" name="id" class="@error('id') border border-danger @enderror" value="{{ old('id') }}">
                </section>
                <section class="login-btn d-grid g-2">
                    <button class="btn btn-danger">ورود به آمازون</button>
                </section>
                <section class="login-terms-and-conditions"><a href="#">شرایط و قوانین</a> را خوانده ام و پذیرفته ام
                </section>
            </section>
        </form>
    </section>


@endsection