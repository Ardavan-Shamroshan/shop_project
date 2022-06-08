<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,!?؟ ]+$/u',
            'description' => 'required|max:2048|min:10',
            'keywords' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,!?؟،؛ ]+$/u',
            'email' => ['required', 'string', 'email'],
            'mobile' => ['required', 'digits:11'],
            'phone1' => ['required', 'string'],
            'phone2' => ['required', 'string'],
            'address' => ['required','max:1024','min:5'],
            'copyright' => ['required','max:1024','min:5'],
            'logo' => 'image|mimes:png,jpg,jpeg,gif',
            'icon' => 'image|mimes:png,jpg,jpeg,gif',
        ];
    }
}
