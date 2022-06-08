<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Guarantee;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product) {
        return view('admin.market.product.guarantee.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product) {
        return view('admin.market.product.guarantee.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product) {
        $request->validate([
            'name' => ['required'],
            'price_increase' => ['required', 'numeric'],
        ]);
        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        Guarantee::query()->create($inputs);
        return redirect()->route('admin.market.product.guarantee', $product->id)->with('swal-success', 'گارانتی با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Guarantee $guarantee) {
        $guarantee->delete();
        return back();
    }
}
