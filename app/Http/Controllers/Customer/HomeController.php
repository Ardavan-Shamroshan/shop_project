<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function home() {
    //    \Auth::login(User::find(2));
//        \Auth::logout();
        $slideShowImages = Banner::query()->where('position', 0)->where('status', 1)->get();
        $topBanners = Banner::query()->where('position', 1)->where('status', 1)->take(2)->get();
        $middleBanners = Banner::query()->where('position', 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::query()->where('position', 3)->where('status', 1)->first();
        $brands = Brand::query()->where('status', 1)->get();
        $mostVisitedProducts = Product::query()->inRandomOrder()->take(10)->get();
        $offerProducts = Product::query()->inRandomOrder()->take(10)->get();
        return view('customer.home', compact('slideShowImages', 'topBanners', 'brands', 'middleBanners', 'bottomBanner', 'mostVisitedProducts', 'offerProducts'));
    }
}
