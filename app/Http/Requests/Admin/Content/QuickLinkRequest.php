<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuickLinkRequest extends FormRequest {
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
            'title' => 'regex:/^[آا-یa-zA-Z0-9.,!? ]+$/u',
            'url' => ['required', 'url', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', Rule::unique('quick_links')->ignore($this->id)],
        ];
    }
}
