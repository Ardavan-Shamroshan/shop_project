<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'code' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,!?؟ ]+$/u',
            'amount_type' => ['required', 'numeric', Rule::in(['0', '1'])],
            'amount' => ['required', (request()->amount_type == 0) ? 'max:100' : '', 'numeric'],
            'discount_selling' => 'required|max:100000000000000000|min:1|numeric',
            'user_id' => ['required_if:type,==,1', 'min:1', 'max:10000000000000000', 'numeric', 'exists:users,id'],
            'type' => ['required', 'numeric', Rule::in(['0', '1'])],
            'status' => ['required', 'numeric', Rule::in(['0', '1'])],
            'start_date' => ['required', 'numeric'],
            'end_date' => ['required', 'numeric'],
        ];
    }

    public function attributes()
    {
        return [
            'type' => 'نوع کوپن',
            'amount_type' => 'نوع تخفیف',
            'amount' => 'میزان تخفیف',
        ];
    }
}
