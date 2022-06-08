<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
{{--        {{ __('Update Password') }}--}}
        {{ __('بروزرسانی رمزعبور') }}
    </x-slot>

    <x-slot name="description">
{{--        {{ __('Ensure your account is using a long, random password to stay secure.') }}--}}
        {{ __('اطمینان حاصل کنید که حساب شما از یک رمز عبور طولانی و تصادفی برای حفظ امنیت استفاده می کند.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
{{--            <x-jet-label for="current_password" value="{{ __('Current Password') }}" />--}}
            <x-jet-label for="current_password" value="{{ __('رمزعبور') }}" />
            <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
{{--            <x-jet-label for="password" value="{{ __('New Password') }}" />--}}
            <x-jet-label for="password" value="{{ __('رمزعبور جدید') }}" />
            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
{{--            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
            <x-jet-label for="password_confirmation" value="{{ __('تایید رمزعبور') }}" />
            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{--            {{ __('Saved.') }}--}}
            {{ __('ذخیره شد.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo" class="font-black">
            {{--            {{ __('Save') }}--}}
            {{ __('ذخیره') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
