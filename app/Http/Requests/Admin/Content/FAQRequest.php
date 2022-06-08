<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
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
            'question' => 'required|max:225|min:5|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/:;،؛\n\r&?؟!«»" ًّ َ ِ ُ ْ () ]+$/u',
            'answer' => 'required|max:550|min:5|regex:/^[آا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/:;،؛\n\r&?؟!«»" ًّ َ ِ ُ ْ (). ]+$/u',
            'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
        ];
    }
}
