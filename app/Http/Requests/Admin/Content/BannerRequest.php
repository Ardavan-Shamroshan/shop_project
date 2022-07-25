<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
{
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
        if ($this->isMethod('post')) {
            return [
                'title' => ['required', 'max:120', 'min:2', 'regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'],
                'url' => ['required', 'max:200', 'min:5', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
                'status' => ['required', 'numeric', Rule::in(['0', '1'])],
                'position' => ['required', 'numeric'],
                'image' => ['required', 'image', 'mimes:png,jpg,jpeg,gif'],
            ];
        } else
            return [
                'title' => ['required', 'max:120', 'min:2', 'regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'],
                'url' => ['required', 'max:200', 'min:5','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
                'status' => ['required', 'numeric', Rule::in(['0', '1'])],
                'position' => ['required', 'numeric'],
                'image' => ['image', 'mimes:png,jpg,jpeg,gif'],
            ];
    }
}
