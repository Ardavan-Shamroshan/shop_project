{{--<x-jet-form-section submit="updateProfileInformation">--}}
{{--    <x-slot name="title">--}}
{{--        {{ __('Profile Information') }}--}}
{{--    </x-slot>--}}

{{--    <x-slot name="description">--}}
{{--        {{ __('Update your account\'s profile information and email address.') }}--}}
{{--    </x-slot>--}}

{{--    <x-slot name="form">--}}
{{--        <!-- Profile Photo -->--}}
{{--        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())--}}
{{--            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">--}}
{{--                <!-- Profile Photo File Input -->--}}
{{--                <input type="file" class="hidden"--}}
{{--                            wire:model="photo"--}}
{{--                            x-ref="photo"--}}
{{--                            x-on:change="--}}
{{--                                    photoName = $refs.photo.files[0].name;--}}
{{--                                    const reader = new FileReader();--}}
{{--                                    reader.onload = (e) => {--}}
{{--                                        photoPreview = e.target.result;--}}
{{--                                    };--}}
{{--                                    reader.readAsDataURL($refs.photo.files[0]);--}}
{{--                            " />--}}

{{--                <x-jet-label for="photo" value="{{ __('Photo') }}" />--}}

{{--                <!-- Current Profile Photo -->--}}
{{--                <div class="mt-2" x-show="! photoPreview">--}}
{{--                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">--}}
{{--                </div>--}}

{{--                <!-- New Profile Photo Preview -->--}}
{{--                <div class="mt-2" x-show="photoPreview" style="display: none;">--}}
{{--                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"--}}
{{--                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">--}}
{{--                    </span>--}}
{{--                </div>--}}

{{--                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">--}}
{{--                    {{ __('Select A New Photo') }}--}}
{{--                </x-jet-secondary-button>--}}

{{--                @if ($this->user->profile_photo_path)--}}
{{--                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">--}}
{{--                        {{ __('Remove Photo') }}--}}
{{--                    </x-jet-secondary-button>--}}
{{--                @endif--}}

{{--                <x-jet-input-error for="photo" class="mt-2" />--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <!-- Name -->--}}
{{--        <div class="col-span-6 sm:col-span-4">--}}
{{--            <x-jet-label for="name" value="{{ __('Name') }}" />--}}
{{--            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />--}}
{{--            <x-jet-input-error for="name" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email -->--}}
{{--        <div class="col-span-6 sm:col-span-4">--}}
{{--            <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />--}}
{{--            <x-jet-input-error for="email" class="mt-2" />--}}
{{--        </div>--}}
{{--    </x-slot>--}}

{{--    <x-slot name="actions">--}}
{{--        <x-jet-action-message class="mr-3" on="saved">--}}
{{--            {{ __('Saved.') }}--}}
{{--        </x-jet-action-message>--}}

{{--        <x-jet-button wire:loading.attr="disabled" wire:target="photo">--}}
{{--            {{ __('Save') }}--}}
{{--        </x-jet-button>--}}
{{--    </x-slot>--}}
{{--</x-jet-form-section>--}}

<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{--        {{ __('Profile Information') }}--}}
        {{ __('اطلاعات حساب کاربری') }}
    </x-slot>

    <x-slot name="description">
        {{--        {{ __('Update your account\'s profile information and email address.') }}--}}
        {{ __('اطلاعات نمایه و آدرس ایمیل حساب خود را به روز کنید.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        {{--        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())--}}



        @if (Auth::user()->profile_photo_path)
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">

                <x-jet-label for="photo" value="{{ __('تصویر پروفایل') }}"/>

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ asset($this->user->profile_photo_path) }}" alt="{{ $this->user->fullname }}" class="rounded-full h-20 w-20 border-2 object-cover">
                </div>
            </div>


        {{--            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">--}}
        {{--                <!-- Profile Photo File Input -->--}}
        {{--                <input type="file" class="hidden"--}}
        {{--                       wire:model="photo"--}}
        {{--                       x-ref="photo"--}}
        {{--                       x-on:change="--}}
        {{--                                    photoName = $refs.photo.files[0].name;--}}
        {{--                                    const reader = new FileReader();--}}
        {{--                                    reader.onload = (e) => {--}}
        {{--                                        photoPreview = e.target.result;--}}
        {{--                                    };--}}
        {{--                                    reader.readAsDataURL($refs.photo.files[0]);--}}
        {{--                            "/>--}}

        {{--                <x-jet-label for="photo" value="{{ __('Photo') }}"/>--}}
        {{--                <x-jet-label for="photo" value="{{ __('تصویر پروفایل') }}"/>--}}

        {{--                <!-- Current Profile Photo -->--}}
        {{--                <div class="mt-2" x-show="! photoPreview">--}}
        {{--                    <img src="{{ asset($this->user->profile_photo_path) }}" alt="{{ $this->user->fullname }}" class="rounded-full h-20 w-20 border-2 object-cover">--}}
        {{--                </div>--}}

        {{--                <!-- New Profile Photo Preview -->--}}
        {{--                <div class="mt-2" x-show="photoPreview">--}}
        {{--                    <span class="block rounded-full w-20 h-20"--}}
        {{--                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">--}}
        {{--                    </span>--}}
        {{--                </div>--}}

        {{--                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">--}}
        {{--                    {{ __('Select A New Photo') }}--}}
        {{--                </x-jet-secondary-button>--}}

        {{--                @if ($this->user->profile_photo_path)--}}
        {{--                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">--}}
        {{--                        {{ __('Remove Photo') }}--}}
        {{--                    </x-jet-secondary-button>--}}
        {{--                @endif--}}

        {{--                <x-jet-input-error for="photo" class="mt-2"/>--}}
        {{--            </div>--}}
    @endif

    <!-- First name -->
        <div class="col-span-6 sm:col-span-4">
            {{--            <x-jet-label for="first_name" value="{{ __('First name') }}"/>--}}
            <x-jet-label for="first_name" value="{{ __('نام') }}"/>
            <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="state.first_name" autocomplete="first_name"/>
            <x-jet-input-error for="first_name" class="mt-2"/>
        </div>

        <!-- Last name -->
        <div class="col-span-6 sm:col-span-4">
            {{--            <x-jet-label for="last_name" value="{{ __('Last name') }}"/>--}}
            <x-jet-label for="last_name" value="{{ __('نام خانوادگی') }}"/>
            <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="state.last_name" autocomplete="last_name"/>
            <x-jet-input-error for="last_name" class="mt-2"/>
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            {{--            <x-jet-label for="email" value="{{ __('Email') }}"/>--}}
            <x-jet-label for="email" value="{{ __('ایمیل') }}"/>
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email"/>
            <x-jet-input-error for="email" class="mt-2"/>
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

