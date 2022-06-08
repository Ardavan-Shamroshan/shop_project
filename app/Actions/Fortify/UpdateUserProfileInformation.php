<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation {
    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($user, array $input) {
        Validator::make($input, [
            // 'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ],[
            'first_name.required' => 'نام الزامی است',
            'first_name.string' => 'نام فقط باید شامل حروف باشد',
            'first_name.max' => 'نام بیش از حد طولانی است',
            'last_name.required' => 'نام خانوادگی الزامی است',
            'last_name.string' => 'نام خانوادگی فقط باید شامل حروف باشد',
            'last_name.max' => 'نام خانوادگی بیش از حد طولانی است',
            'email.max' => 'پست الکترونیک بیش از حد طولانی است',
        ])->validateWithBag('updateProfileInformation');


        // if (isset($input['photo'])) {
        //     $user->updateProfilePhoto($input['photo']);
        // }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                // 'name' => $input['name'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input) {
        // $user->forceFill([
        //     // 'name' => $input['name'],
        //     'first_name' => $input['first_name'],
        //     'last_name' => $input['last_name'],
        //     'email' => $input['email'],
        //     'email_verified_at' => null,
        // ])->save();
        //
        // $user->sendEmailVerificationNotification();
        $user->forceFill([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
