<?php

namespace App\Http\Controllers\Customer\Market;

use App\Models\Content\Comment;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product(Product $product) {
        $relatedProducts = Product::all();
        $comments = $product->approvedComments();
        $productGallery = $product->images;
        $productImages = collect();
        $productImages->push($product->image);
        foreach ($productGallery as $image)
            $productImages->push($image->image);

        $productColors = $product->colors;
        $productGuaranties = $product->guarantees;
        $amazingSale = $product->activeAmazingSales();

        if (!empty($amazingSale)) {
            $amazingSaleProductPrice = ($product->price * $amazingSale->percentage) / 100;
            return view('customer.market.product.product', compact('product', 'relatedProducts', 'productImages', 'productColors', 'productGuaranties', 'amazingSale', 'amazingSaleProductPrice', 'comments'));
        }
        return view('customer.market.product.product', compact('product', 'relatedProducts', 'productImages', 'productColors', 'productGuaranties', 'comments'));
    }

    public function addComment(Product $product, Request $request) {
        $validated = $request->validate([
            'body' => ['required', 'max:2048'],
        ]);

        $inputs['body'] = str_replace(PHP_EOL, '<br>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;
        Comment::query()->create($inputs);
        return redirect()->route('customer.market.product', $product)->with('swal-success', 'نظر شما با موفقیت تایید شد');
    }

    public function addToFavorite(Product $product) {
        if (Auth::check()) {
            $product->users()->toggle([Auth::user()->id]);
            if ($product->users->contains(Auth::user()->id))
                return response()->json(['status' => 1]);
            else
                return response()->json(['status' => 2]);
        } else return response()->json(['status' => 3]);

    }
}
