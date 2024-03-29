<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post'))
        return [
            'first_name' => 'required|max:120|min:1',
            'last_name' => 'required|max:120|min:1',
            'mobile' => ['required', 'digits:11', 'unique:users'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'national_code' => ['nullable', 'digits:10', 'unique:users'],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
            'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'activation' => ['required', 'numeric', Rule::in(['0', '1'])],
        ];
        else return [
            'first_name' => 'required|max:120|min:1',
            'last_name' => 'required|max:120|min:1',
            'national_code' => ['nullable', 'digits:10', Rule::unique('users')->ignore($this->id)],
            'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
        ];
    }
}
