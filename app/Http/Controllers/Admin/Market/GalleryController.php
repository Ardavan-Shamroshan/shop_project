<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Gallery;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, ImageService $imageService)
    {
        $request->validate([
            'image' => 'image|mimes:png,jpg,jpeg,gif',
        ]);
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false)
                return redirect()->route('admin.market.product.gallery', $product->id)->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['image'] = $result;
        }
        $inputs['product_id'] = $product->id;
        Gallery::query()->create($inputs);
        return redirect()->route('admin.market.product.gallery', $product->id)->with('swal-success', 'تصویر جدید شما با موفقیت ثبت شد');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.market.product.gallery', $product->id)->with('swal-success', 'تصویر کالا با موفقیت حذف شد');
    }
}
