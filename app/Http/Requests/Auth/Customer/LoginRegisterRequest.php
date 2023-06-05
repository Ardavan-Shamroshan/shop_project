<?php

namespace App\Http\Requests\Auth\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class LoginRegisterRequest extends FormRequest
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
        $route = Route::current();
        if($route->getName() == 'auth.customer.loginRegister') {
            return [
                'id' => ['required', 'min:11', 'max:64'],
            ];
        } elseif($route->getName() == 'auth.customer.loginConfirm') {
            return [
                'otp' => ['required', 'min:6', 'max:6']
            ];
        }
    }

    public function attributes() {
        return [
            'id' => 'شماره موبایل یا پست الکترونیک'
        ];
    }
}
