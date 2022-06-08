<?php

namespace App\Http\Requests\Admin\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketCategoryRequest extends FormRequest
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
            'name' => 'required|max:120|min:2|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,،!?؟ ]+$/u',
            'status' => ['required', 'numeric', Rule::in(['0', '1'])],
        ];
    }
}
