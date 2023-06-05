<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::query()->orderBy('created_at', 'asc')->toSql();
        // dd($products);
        $products = Product::with('category')->latest()->simplePaginate(15);
        return view('admin.market.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {

        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false)
                return redirect()->route('admin.market.product')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['image'] = $result;
        }

        // Rolling back the entire operation if one of $product or $metas failed
        DB::transaction(function () use ($request, $inputs) {
            // Insert the new product into <products> table
            // $product = Product::query()->create($inputs)->toSql();
            // dd($product);
            $product = Product::query()->create($inputs);

            /*
             | array:17 [▼
             |     ...
             |     "meta_key" => array:2 [▼
             |          0 => "Water-Proof"
             |          1 => "Anti-shock"
             |      ]
             |     "meta_value" => array:2 [▼
             |          0 => "yes"
             |         1 => "no"
             |      ]
             |      ...
             | ]
             |
             | meta_key and meta_value should combine into one array with meta_keys values as array keys and meta_values values as array values.
             | then the generated array values must be inserted to <product_meta> table.
              */
            $metas = array_combine($request->meta_key, $request->meta_value);
            foreach ($metas as $key => $value)
                ProductMeta::query()->create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id' => $product->id,
                ]);
        });
        return redirect()->route('admin.market.product')->with('swal-success', 'محصول جدید شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        if ($request->hasFile('image')) {
            if (!empty($product->image))
                $imageService->deleteDirectoryAndFiles($product->image['directory']);
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false)
                return redirect()->route('admin.market.product')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['image'] = $result;
        } else
            if (isset($inputs['currentImage']) && !empty($product->image)) {
                $image = $product->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }

        // Rolling back the entire operation if one of $product or $metas failed
//        DB::transaction(function () use ($request, $inputs) {
        // Insert the new product into <products> table
//            $product = Product::query()->create($inputs);

        /*
         | array:17 [▼
         |     ...
         |     "meta_key" => array:2 [▼
         |          0 => "Water-Proof"
         |          1 => "Anti-shock"
         |      ]
         |     "meta_value" => array:2 [▼
         |          0 => "yes"
         |         1 => "no"
         |      ]
         |      ...
         | ]
         |
         | meta_key and meta_value should combine into one array with meta_keys values as array keys and meta_values values as array values.
         | then the generated array values must be inserted to <product_meta> table.
          */
//            $metas = array_combine($request->meta_key, $request->meta_value);
//            foreach ($metas as $key => $value)
//                ProductMeta::query()->create([
//                    'meta_key' => $key,
//                    'meta_value' => $value,
//                    'product_id' => $product->id,
//                ]);
//        });
        $product->update($inputs);

        $metaKeys = $request->meta_key;
        $metaValues = $request->meta_value;
        $metaIds = array_keys($metaKeys);

        $metas = array_map(function ($metaId, $metaKey, $metaValue) {
            return array_combine(
                ['meta_id', 'meta_key', 'meta_value'],
                [$metaId, $metaKey, $metaValue]
            );
        }, $metaIds, $metaKeys, $metaValues);

        foreach ($metas as $meta)
            ProductMeta::query()->where('id', $meta['meta_id'])->update([
                'meta_key' => $meta['meta_key'],
                'meta_value' => $meta['meta_value'],
            ]);

        return redirect()->route('admin.market.product')->with('swal-success', 'محصولشما با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.market.product')->with('swal-success', 'محصول شما با موفقیت حذف شد');

    }
}
