<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Models\Market\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index() {
        $user = Auth::user(); $addresses = $user->addresses;
        $provinces = Province::all();
        return view('customer.profile.addresses.my-addresses', compact('provinces', 'addresses'));
    }
}
