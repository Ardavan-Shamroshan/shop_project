<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileCompletionController extends Controller
{
    public function profileCompletion() {
        $user = Auth::user();
        $cartItems = CartItem::query()->where('user_id', $user->id)->get();
        return view('customer.sales-process.profile-completion', compact('user', 'cartItems'));
    }

    public function completion(Request $request) {
        $user = Auth::user();
        $validated = $request->validate([
            'first_name' => ['sometimes', 'required'],
            'last_name' => ['sometimes', 'required'],
            'email' => ['sometimes', 'required', 'email', Rule::unique('users')->ignore($user)],
            'mobile' => ['sometimes', 'required', 'min:10', 'max:13', Rule::unique('users')->ignore($user)],
            'national_code' => ['sometimes', 'required', Rule::unique('users')->ignore($user)],
        ]);

        $inputs = $request->all();
        $user->update($inputs);
        return redirect()->route('customer.sales-process.address-and-delivery');
    }
}
