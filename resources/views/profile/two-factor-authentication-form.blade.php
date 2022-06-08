<x-jet-action-section>
    <x-slot name="title">
{{--        {{ __('Two Factor Authentication') }}--}}
        {{ __('احراز هویت دو مرحله ایی') }}
    </x-slot>

    <x-slot name="description">
{{--        {{ __('Add additional security to your account using two factor authentication.') }}--}}
        {{ __('با استفاده از احراز هویت دو مرحله ای، امنیت بیشتری را به حساب خود اضافه کنید.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
{{--                {{ __('You have enabled two factor authentication.') }}--}}
                {{ __('شما احراز هویت دو مرحله ای را فعال کرده اید.') }}
            @else
{{--                {{ __('You have not enabled two factor authentication.') }}--}}
                {{ __('شما احراز هویت دو مرحله ای را فعال نکرده اید.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
{{--                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}--}}
                {{ __('هنگامی که احراز هویت دو مرحله ای فعال است، در حین احراز هویت از شما خواسته می شود که یک نشانه امن و تصادفی داشته باشید. می توانید این نشانه را از برنامه Google Authenticator گوشی خود بازیابی کنید.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
{{--                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}--}}
                        {{ __('احراز هویت دو مرحله ای اکنون فعال است. کد QR زیر را با استفاده از برنامه احراز هویت گوشی خود اسکن کنید.') }}
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
{{--                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}--}}
                        {{ __('این کدهای بازیابی را در یک مدیر رمز عبور امن ذخیره کنید. اگر دستگاه احراز هویت دو مرحله ای شما گم شود، می توان از آنها برای بازیابی دسترسی به حساب شما استفاده کرد.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled" class="font-black">
{{--                        {{ __('Enable') }}--}}
                        {{ __('فعال سازی') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
{{--                            {{ __('Regenerate Recovery Codes') }}--}}
                            {{ __('بازیابی کدهای بازیابی') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
{{--                            {{ __('Show Recovery Codes') }}--}}
                            {{ __('نمایش کدهای بازیابی') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
{{--                        {{ __('Disable') }}--}}
                        {{ __('غیرفعال سازی') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
