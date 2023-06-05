<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SlideRequest extends FormRequest
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
                'title'  => 'required|max:120|min:2',
                'body'   => 'required|max:2048|min:5',
                'url'    => ['nullable', 'url', Rule::unique('quick_links')->ignore($this->id)],
                'image'  => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => ['required', 'numeric', Rule::in(['0', '1'])],
            ];
        else
            return [
                'title'  => 'required|max:120|min:2',
                'body'   => 'required|max:2048|min:5',
                'url'    => ['nullable', 'url', Rule::unique('quick_links')->ignore($this->id)],
                'image'  => 'image|mimes:png,jpg,jpeg,gif',
                'status' => ['required', 'numeric', Rule::in(['0', '1'])],
            ];
    }
}
