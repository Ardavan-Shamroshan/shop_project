<x-jet-action-section>
    <x-slot name="title">
{{--        {{ __('Delete Account') }}--}}
        {{ __('حذف حساب کاربری') }}
    </x-slot>

    <x-slot name="description">
{{--        {{ __('Permanently delete your account.') }}--}}
        {{ __('اکانت خود را برای همیشه حذف کنید') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
{{--            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}--}}
            {{ __('پس از حذف حساب شما، تمام منابع و داده های آن برای همیشه حذف خواهند شد. قبل از حذف حساب خود، لطفاً هر گونه داده یا اطلاعاتی را که می خواهید حفظ کنید دانلود کنید.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
{{--                {{ __('Delete Account') }}--}}
                {{ __('حذف حساب کاربری') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
{{--                {{ __('Delete Account') }}--}}
                {{ __('حذف حساب کاربری') }}

            </x-slot>

            <x-slot name="content">
{{--                {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}--}}
                {{ __('آیا مطمئن هستید که می خواهید اکانت خود را حذف کنید؟ پس از حذف حساب شما، تمام منابع و داده های آن برای همیشه حذف خواهند شد. لطفاً رمز عبور خود را وارد کنید تا تأیید کنید که می خواهید حساب خود را برای همیشه حذف کنید.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
{{--                                placeholder="{{ __('Password') }}"--}}
                                placeholder="{{ __('رمز عبور') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
{{--                    {{ __('Cancel') }}--}}
                    {{ __('لغو') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
{{--                    {{ __('Delete Account') }}--}}
                    {{ __('حذف حساب کاربری') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
