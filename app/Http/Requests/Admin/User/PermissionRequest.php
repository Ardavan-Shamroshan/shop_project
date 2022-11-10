<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class PermissionRequest extends FormRequest
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
        return [
            'name' => 'required|max:120|min:1',
            'description' => 'required|max:220|min:2',
        ];
    }

    public function attributes() {
        return [
            'name' => 'عنوان دسترسی',
            'description' => 'توضیح دسترسی',
        ];
    }
}