<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostCategoryRequest extends FormRequest
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
                'name' => 'required|max:120|min:2',
                'description' => 'required|max:500|min:5',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => ['required', 'numeric', Rule::in(['0', '1'])],
                'tags' => 'nullable',
            ];
        else
            return [
                'name' => 'required|max:120|min:2',
                'description' => 'required|max:500|min:5',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => ['required', 'numeric', Rule::in(['0', '1'])],
                'tags' => 'nullable',
            ];
    }
}
