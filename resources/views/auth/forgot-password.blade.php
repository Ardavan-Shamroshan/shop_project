<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600" dir="rtl">
{{--            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
            {{ __('رمز عبور خود را فراموش کرده اید؟ مشکلی ندارد. فقط کافیست که ایمیل خودتان را به ما بگویید تا ما برای شما لینک تغییر رمز عبورتان را ارسال کنیم') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}"  dir="rtl">
            @csrf

            <div class="block">
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
                <x-jet-label for="email" value="{{ __('ایمیل') }}"/>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="font-black">
{{--                    {{ __('Email Password Reset Link') }}--}}
                    {{ __('ارسال ایمیل تغییر رمز عبور') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
