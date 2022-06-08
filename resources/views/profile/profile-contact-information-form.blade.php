<x-jet-form-section submit="updateProfileContactInformation">
    <x-slot name="title">
{{--        {{ __('Profile Contact Information') }}--}}
        {{ __('اطلاعات حساب کاربری') }}
    </x-slot>

    <x-slot name="description">
{{--        {{ __('Update your account\'s profile contact information.') }}--}}
        {{ __('اطلاعات تماس نمایه حساب خود را به روز کنید.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
{{--            <x-jet-label for="mobile" value="{{ __('Phone') }}" />--}}
            <x-jet-label for="mobile" value="{{ __('تلفن همراه') }}" />
            <x-jet-input id="mobile" type="text" class="mt-1 block w-full" wire:model.defer="state.mobile" />
            <x-jet-input-error for="mobile" class="mt-2" />
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
