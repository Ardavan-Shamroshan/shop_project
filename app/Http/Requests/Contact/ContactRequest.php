<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest {
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
            'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z ]+$/u',
            'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z ]+$/u',
            'email' => ['required', 'string', 'email', 'unique:users'],
            'mobile' => ['required', 'digits:11'],
            'subject' => 'required|max:20|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'message' => 'required|max:80|min:5|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/:;،؛\n\r&?؟!«»" ًّ َ ِ ُ ْ () ]+$/u',
        ];
    }
}
