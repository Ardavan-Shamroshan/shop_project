<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $slideShowImages = Banner::query()->where('position', 0)->where('status', 1)->get();
        $topBanners = Banner::query()->where('position', 1)->where('status', 1)->take(2)->get();
        $middleBanners = Banner::query()->where('position', 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::query()->where('position', 3)->where('status', 1)->first();
        $brands = Brand::query()->where('status', 1)->get();
        $mostVisitedProducts = Product::query()->inRandomOrder()->take(10)->get();
        $offerProducts = Product::query()->inRandomOrder()->take(10)->get();
        return view('customer.home', compact('slideShowImages', 'topBanners', 'brands', 'middleBanners', 'bottomBanner', 'mostVisitedProducts', 'offerProducts'));
    }

    public function products(Request $request, ProductCategory $category)
    {
        // brands
        $brands = Brand::all();
        $parentCategories = ProductCategory::with('children')
            ->whereNull('parent_id')
            ->get();

        // initialize category and related products
        $productModel = !empty($category->getOriginal())
            ? $category->load('products')->products()
            : new Product();

        // set sort options
        switch ($request->sort) {
            case '1':
                $column = 'created_at';
                $direction = 'DESC';
                break;
            case '2':
                $column = 'price';
                $direction = 'DESC';
                break;
            case '3':
                $column = 'price';
                $direction = 'ASC';
                break;
            case '4':
                $column = 'view';
                $direction = 'DESC';
                break;
            case '5':
                $column = 'sold_number';
                $direction = 'DESC';
                break;
            default:
                $column = 'created_at';
                $direction = 'ASC';
        }

        $products = $productModel
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->search%");
            })
            ->when($request->min_price, function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            })
            ->when($request->max_price, function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            })
            ->when($request->brands, function ($query) use ($request) {
                $query->whereIn('brand_id', $request->brands);
            })
            ->orderBy($column, $direction)
            ->paginate(2)
            // add previous queries to the paginator
            ->appends($request->query());

        // select only persian name from selected brands query
        $selectedBrands = Brand::query()
            ->when($request->brands)
            ->find($request->brands, ['persian_name']);

        return view('customer.market.product.products', compact('products', 'brands', 'selectedBrands', 'parentCategories', 'category'));
    }
}
