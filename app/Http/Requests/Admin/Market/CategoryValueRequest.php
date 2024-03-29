<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryValueRequest extends FormRequest
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
            'value' => 'required|max:120|min:2',
            'price_increase' => 'required|numeric',
            'product_id' => 'required|min:1|max:100000000|exists:products,id',
            'type' => ['required',  Rule::in(['0', '1'])],
        ];
    }
}
