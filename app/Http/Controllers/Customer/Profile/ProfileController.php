<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        // check if user is authenticated
        $authenticated = Auth::check();
        if ($authenticated):
            // head to the profile page with authenticated user data
            $user = Auth::user();
            return view('customer.profile.profile', compact('user'));
        else:
            // return to the home page
            return redirect()->route('customer.home');
        endif;
    }

    public function update(UpdateProfileRequest $request) {
        // define fillable attributes
        $inputs = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'national_code' => $request->national_code,
        ];

        $user = Auth::user();
        $user->update($inputs);
        return redirect()->route('customer.profile')->with('alert-section-success', 'حساب کاربری شما با موفقیت ویرایش شد');

        
    }
}
