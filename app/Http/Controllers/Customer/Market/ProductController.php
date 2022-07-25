<?php

namespace App\Http\Controllers\Customer\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function product(Product $product)
    {
        $relatedProducts = Product::all();
        $productGallery = $product->images;
        $productImages = collect();
        $productImages->push($product->image);
        foreach ($productGallery as $image)
            $productImages->push($image->image);

        $productColors = $product->colors;
        $productColors = $product->colors;
        $productGuaranties = $product->guarantees;
        $amazingSale = $product->activeAmazingSales();
        if (!empty($amazingSale)) {
            $amazingSaleProductPrice = ($product->price * $amazingSale->percentage) / 100;
            return view('customer.market.product.product', compact('product', 'relatedProducts', 'productImages', 'productColors', 'productGuaranties', 'amazingSale', 'amazingSaleProductPrice'));
        }
        return view('customer.market.product.product', compact('product', 'relatedProducts', 'productImages', 'productColors', 'productGuaranties', 'amazingSale'));
    }

    public function addComment()
    {
    }
}
