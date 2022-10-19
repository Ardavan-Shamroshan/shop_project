<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index() {
        return view('customer.profile.favorites.my-favorites');
    }

    public function remove(Product $product) {
        $user = Auth::user();
        $user->products()->detach($product->id);
        return redirect()->route('customer.profile.my-favorites')->with('alert-section-success', 'محصول با موفقیت از علاقه مندی ها حذف شد');
    }
}
