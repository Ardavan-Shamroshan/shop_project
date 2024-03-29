<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AmazingSaleRequest extends FormRequest
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
            'percentage' => 'required|max:100|min:1|numeric',
            'product_id' => 'required|min:1|max:100000000|exists:products,id',
            'status' => ['required', 'numeric', Rule::in(['0', '1'])],
            'start_date' => ['required', 'numeric'],
            'end_date' => ['required', 'numeric'],
        ];
    }
}
