<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
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
            'name' => 'required|max:225|min:2',
            'url' => 'nullable|max:500|min:5',
            'parent_id' => 'nullable|exists:menus,id',
            'status' => ['required', 'numeric', Rule::in(['0', '1'])],
        ];
    }
}
