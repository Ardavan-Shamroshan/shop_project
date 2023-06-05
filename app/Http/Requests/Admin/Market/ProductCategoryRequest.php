<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCategoryRequest extends FormRequest
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
        return [
            'name'         => 'required|max:120|min:2',
            'description'  => 'max:500|min:5',
            'image'        => 'image|mimes:png,jpg,jpeg,gif',
            'status'       => ['required', 'numeric', Rule::in(['0', '1'])],
            'show_in_menu' => ['required', 'numeric', Rule::in(['0', '1'])],
            'tags'         => ['nullable', 'string'],
            'parent_id'    => 'nullable|exists:product_categories,id',
        ];
    }
}
