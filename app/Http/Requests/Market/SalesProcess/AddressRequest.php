<?php

namespace App\Http\Requests\Market\SalesProcess;

use App\Rules\PostalCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = Auth::user();
        return [
            'province_id' => ['required', 'exists:provinces,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'address' => ['required'],
            'postal_code' => ['required', new PostalCode],
            'no' => ['required'],
            'unit' => ['required'],
            'receiver' => ['sometimes'],
            'recipient_first_name' => ['required_with:receiver,on'],
            'recipient_last_name' => ['required_with:receiver,on'],
            'mobile' => ['required_with:receiver,on'],
        ];
    }

    public function attributes()
    {
        return [
            'province_id' => 'استان',
            'city_id' => 'شهر',
            'no' => 'پلاک',
            'unit' => 'واحد',
            'recipient_first_name' => 'نام گیرنده',
            'recipient_last_name' => 'نام خانوادگی گیرنده',
            'mobile' => 'موبایل گیرنده'
        ];
    }
}
