@extends('customer.layouts.master-simple')

@section('head-tag')

    <style>
        #resend-otp {
            font-size: 1rem;
        }
    </style>

@endsection

@section('content')

    <section class="vh-100 d-flex justify-content-center align-items-center pb-5 mt-5">
        <form action="{{ route('auth.customer.loginConfirm', $token) }}" method="post">
            @csrf
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img src="{{ asset('customer-assets/assets/images/logo/4.png') }}" class="p-2 rounded bg-light shadow-sm" alt="login-logo">
                </section>
                <section class="login-title mb-2">
                    <a href="{{ route('auth.customer.loginRegisterForm') }}"><i class="fa fa-arrow-right"></i></a>
                </section>
                <section class="login-title ">لطفا کد تایید را وارد نمایید</section>

                @if($otp->type == 0)
                    <section class="login-info">
                        <small> کد تایید برای شماره موبایل {{$otp->login_id}} ارسال گردید</small>
                    </section>
                @else
                    <section class="login-info">
                        <small> کد تایید برای ایمیل {{$otp->login_id}} ارسال گردید</small>
                    </section>
                @endif
                <section class="login-input-text">
                    @error('otp')
                    <span class="alert_required text-danger" role="alert">
                            <small class="font-weight-bold">{{ $message }}</small>
                    </span>
                    @enderror
                    <input type="text" name="otp" class="@error('otp') border border-danger @enderror" value="{{ old('otp') }}">
                </section>
                <section class="login-btn d-grid g-2">
                    <button class="btn btn-danger" type="submit">تایید</button>
                </section>

                <section id="resend-otp" class="d-none">
                    <a href="{{ route('auth.customer.loginResendOtp', $token) }}" class="text-decoration-none text-primary">دریافت مجدد کد تایید</a>
                </section>

                <section class="text-center pb-0"><small id="timer"></small></section>

            </section>
        </form>
    </section>
@endsection

@section('script')
    @php
        $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(5)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
    @endphp

    <script>
        var countDownDate = new Date().getTime() + {{ $timer }};
        var timer = $('#timer');
        var resend_otp = $('#resend-otp');

        var x = setInterval(function () {
            var now = new Date().getTime(); // current time
            var distance = countDownDate - now; // period time between otp created time and current time

            // extract seconds and minutes from timestamp format
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // convert numbers(seconds and minutes) in minimum two digits => 02:56, 00:32
            minutes = minutes.toLocaleString(undefined, {minimumIntegerDigits: 2})
            seconds = seconds.toLocaleString(undefined, {minimumIntegerDigits: 2})

            if (minutes === 0)
                timer.html(seconds + ' : ' + minutes + ' تا  ارسال مجدد کد تایید');
            else
                timer.html(seconds + ' : ' + minutes + ' تا  ارسال مجدد کد تایید');

            if (distance < 0) {
                clearInterval(x);
                timer.addClass('d-none');
                resend_otp.removeClass('d-none');
            }
        }, 1000);
    </script>

@endsection