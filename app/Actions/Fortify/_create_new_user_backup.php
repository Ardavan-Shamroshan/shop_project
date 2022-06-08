<?php
//
// namespace App\Actions\Fortify;
//
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use Laravel\Fortify\Contracts\CreatesNewUsers;
// use Laravel\Jetstream\Jetstream;
//
// class CreateNewUser implements CreatesNewUsers {
//     use PasswordValidationRules;
//
//     /**
//      * Validate and create a newly registered user.
//      *
//      * @param array $input
//      * @return \App\Models\User
//      * @throws \Illuminate\Validation\ValidationException
//      */
//     public function create(array $input) {
//         Validator::make($input, [
//             // 'name' => ['required', 'string', 'max:255'],
//             'first_name' => ['required', 'string', 'max:255'],
//             'last_name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//             'mobile' => ['required', 'digits:11', 'unique:users'],
//             'password' => $this->passwordRules(),
//             'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
//         ], [
//             'first_name.required' => 'نام الزامی است',
//             'first_name.string' => 'نام فقط باید شامل حروف باشد',
//             'first_name.max' => 'نام بیش از حد طولانی است',
//             'last_name.required' => 'نام خانوادگی الزامی است',
//             'last_name.string' => 'نام خانوادگی فقط باید شامل حروف باشد',
//             'last_name.max' => 'نام خانوادگی بیش از حد طولانی است',
//             'email.max' => 'پست الکترونیک بیش از حد طولانی است',
//         ])->validate();
//
//         return User::query()->create([
//             // 'name' => $input['name'],
//             'first_name' => $input['first_name'],
//             'last_name' => $input['last_name'],
//             'email' => $input['email'],
//             'mobile' => $input['mobile'],
//             'password' => Hash::make($input['password']),
//         ]);
//     }
// }
