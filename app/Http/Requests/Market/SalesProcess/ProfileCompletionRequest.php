<?php

namespace App\Http\Requests\Market\SalesProcess;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileCompletionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        $user = Auth::user();
        return [
            'first_name' => ['sometimes', 'required'],
            'last_name' => ['sometimes', 'required'],
            'email' => ['sometimes', 'email', Rule::unique('users')->ignore($user)],
            'mobile' => ['sometimes', 'min:10', 'max:13', Rule::unique('users')->ignore($user)],
            'national_code' => ['sometimes', 'required', new NationalCode, Rule::unique('users')->ignore($user)],
        ];
    }
}
