<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'receiver' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,!?؟ ]+$/u',
                'deliverer' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,!?؟ ]+$/u',
                'description' => 'required|max:500|min:5|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/:;،؛\n\r&?؟!«»" ًّ َ ِ ُ ْ () ]+$/u',
                'marketable_number' => ['required', 'numeric'],
            ];
        else return [
            'marketable_number' => ['required', 'numeric'],
            'frozen_number' => ['required', 'numeric'],
            'sold_number' => ['required', 'numeric'],
        ];
    }
}
