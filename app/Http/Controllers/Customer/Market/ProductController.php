<?php

namespace App\Http\Controllers\Customer\Market;

use App\Models\Content\Comment;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function product(Product $product)
    {
        $relatedProducts = Product::with('colors', 'amazingSales')->get();
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

    public function addComment(Product $product, Request $request)
    {
        $validated = $request->validate([
            'body' => ['required', 'max:2048'],
        ]);

        $validated['body'] = str_replace(PHP_EOL, '<br>', $request->body);
        $validated['author_id'] = Auth::user()->id;
        $validated['commentable_id'] = $product->id;
        $validated['commentable_type'] = Product::class;
        Comment::query()->create($validated);
        return redirect()->route('customer.market.product', $product)->with('swal-success', 'نظر شما با موفقیت تایید شد');
    }

    public function addToFavorite(Product $product)
    {
        if (Auth::check()) {
            $product->users()->toggle([Auth::user()->id]);
            if ($product->users->contains(Auth::user()->id))
                return response()->json(['status' => 1]);
            else
                return response()->json(['status' => 2]);
        } else return response()->json(['status' => 3]);
    }

    public function addRate(Request $request, Product $product)
    {
        $validated = $request->validate(['rating' => [Rule::in([1, 2, 3, 4, 5])]]);
        $product_ids = auth()->user()->isUserPurchasedProduct($product->id);
        if (auth()->check() && $product_ids->isNotEmpty()) {
            auth()->user()->rate($product, $validated['rating']);
            return redirect()->route('customer.products')->with('alert-section-success', 'امتیاز شما ثبت شد. نظرات و امتیازات شما موجب بهبود عملکرد ما میشود.');
        } else
            return to_route('auth.customer.loginRegister');
    }
}
