<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest {
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
        if ($this->isMethod('post'))
            return [
                // 'title' => 'required|max:120|min:2|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,،!?؟]+$/u',
                'title' => 'required|max:120|min:2',
                'summary' => 'required|max:300|min:5|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/:;،؛\n\r&?؟!«»" ًّ َ ِ ُ ْ () ]+$/u',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => ['required', 'numeric', Rule::in(['0', '1'])],
                'body' => 'required|max:2048|min:5|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/:;،؛\n\r&?؟!«»" ًّ َ ِ ُ ْ () ]+$/u',
            ];
        else
            return [
                // 'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'title' => 'required|max:120|min:2',
                'summary' => 'required|max:300|min:5|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/:;،؛\n\r&?؟!«»" ًّ َ ِ ُ ْ () ]+$/u',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => ['required', 'numeric', Rule::in(['0', '1'])],
                'body' => 'required|max:2048|min:5|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/:;،؛\n\r&?؟!«»" ًّ َ ِ ُ ْ () ]+$/u',
            ];
    }
}
