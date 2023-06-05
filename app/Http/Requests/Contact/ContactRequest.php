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
            'first_name' => 'required|max:120|min:1',
            'last_name' => 'required|max:120|min:1',
            'email' => ['required', 'string', 'email', 'unique:users'],
            'mobile' => ['required', 'digits:11'],
            'subject' => 'required|max:20|min:2',
            'message' => 'required|max:80|min:5',
        ];
    }
}
