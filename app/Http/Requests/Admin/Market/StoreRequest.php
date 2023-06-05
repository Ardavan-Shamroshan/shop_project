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
                'receiver' => 'required|max:120|min:2',
                'deliverer' => 'required|max:120|min:2',
                'description' => 'required|max:500|min:5',
                'marketable_number' => ['required', 'numeric'],
            ];
        else return [
            'marketable_number' => ['required', 'numeric'],
            'frozen_number' => ['required', 'numeric'],
            'sold_number' => ['required', 'numeric'],
        ];
    }
}
