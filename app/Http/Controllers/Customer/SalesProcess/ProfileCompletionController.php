<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\SalesProcess\ProfileCompletionRequest;
use App\Models\Market\CartItem;
use Illuminate\Support\Facades\Auth;

class ProfileCompletionController extends Controller
{
    public function profileCompletion()
    {
        $user = Auth::user();
        $cartItems = CartItem::query()->where('user_id', $user->id)->get();
        return view('customer.sales-process.profile-completion', compact('user', 'cartItems'));
    }

    public function completion(ProfileCompletionRequest $request)
    {
        $user = Auth::user();
        $inputs = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'national_code' => $request->national_code,
        ];

        // mobile check
        if (isset($request->mobile) && empty($user->mobile)) {
            $mobile = convertArabicToEnglish($request->mobile);
            $mobile = convertPersianToEnglish($mobile);

            if (preg_match('/^(\+98|98|0)9\d{9}$/', $mobile)) {
                // mobile
                $type = 0;
                // all mobile numbers are in format 9** *** ***
                $mobile = ltrim($mobile, '0');
                $mobile = str_starts_with($mobile, '98') ? substr($mobile, 2) : $mobile;
                $mobile = str_replace('+98', '', $mobile);
                $inputs['mobile'] = $mobile;
            } else {
                $errorText = 'فرمت شماره موبایل صحیح نیست';
                return redirect()->back()->withErrors('mobile', $errorText);
            }
        }


        // email check
        if (isset($request->email) && empty($user->email)) {
            $email = convertArabicToEnglish($request->email);
            $email = convertPersianToEnglish($email);
            $inputs['$email'] = $email;
        }

        // remove empty indexes of array
        $inputs = array_filter($inputs);
        if (!empty($inputs))
            $user->update($inputs);

        return redirect()->route('customer.sales-process.address-and-delivery');
    }
}
