<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Http\Requests\Admin\Market\CouponRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Coupon;
use App\Models\Market\Product;
use App\Models\User;

class DiscountController extends Controller
{
    /*
    * ----------------------------------------------------------------------
    * Coupon Methods
    * ----------------------------------------------------------------------
    */
    public function coupon()
    {
        $coupons = Coupon::all();
        return view('admin.market.discount.coupon', compact('coupons'));
    }

    public function couponCreate()
    {
        $users = User::all();
        return view('admin.market.discount.coupon-create', compact('users'));
    }

    public function couponStore(CouponRequest $request){
        $inputs = $request->all();
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realTimestampEnd);
        if ($inputs['type'] == 0)
            $inputs['user_id'] = null;
        Coupon::query()->create($inputs);
        return redirect()->route('admin.market.discount.coupon')->with('swal-success', 'کوپن جدید شما با موفقیت ثبت شد');
    }
    public function couponEdit(Coupon $coupon){
        $users = User::all();
        return view('admin.market.discount.coupon-edit', compact('coupon', 'users'));
    }
    public function couponUpdate(CouponRequest $request, Coupon $coupon){
        $inputs = $request->all();
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realTimestampEnd);
        if ($inputs['type'] == 0)
            $inputs['user_id'] = null;
        else $inputs['user_id'] = $request->user_id;
        $coupon->update($inputs);
        return redirect()->route('admin.market.discount.coupon')->with('swal-success', 'کوپن شما با موفقیت ویرایش شد');
    }
    public function couponDestroy(Coupon $coupon){
        $coupon->delete();
        return redirect()->route('admin.market.discount.coupon')->with('swal-success', 'کوپن شما با موفقیت حذف شد');
    }

    /*
    * ----------------------------------------------------------------------
    * Common Discount Methods
    * ----------------------------------------------------------------------
    */
    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::all();
        return view('admin.market.discount.commonDiscount', compact('commonDiscounts'));
    }

    public function commonDiscountCreate()
    {
        return view('admin.market.discount.commonDiscount-create');
    }

    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realTimestampEnd);
        CommonDiscount::query()->create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف جدید شما با موفقیت ثبت شد');
    }

    public function commonDiscountEdit(CommonDiscount $commonDiscount)
    {
        return view('admin.market.discount.commonDiscount-edit', compact('commonDiscount'));
    }

    public function commonDiscountUpdate(CommonDiscountRequest $request, CommonDiscount $commonDiscount)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realTimestampEnd);
        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف شما با موفقیت ویرایش شد');

    }

    public function commonDiscountDestroy(CommonDiscount $commonDiscount)
    {
        $commonDiscount->delete();
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف شما با موفقیت حذف شد');
    }


    /*
     * ----------------------------------------------------------------------
     * Amazing Sale Methods
     * ----------------------------------------------------------------------
     */
    public function amazingSale()
    {
        $amazingSales = AmazingSale::all();
        return view('admin.market.discount.amazingSale', compact('amazingSales'));
    }

    public function amazingSaleCreate()
    {
        $products  = Product::all();
        return view('admin.market.discount.amazingSale-create', compact('products'));
    }

    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realTimestampEnd);
        AmazingSale::query()->create($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'فروش شگفت انگیز جدید شما با موفقیت ثبت شد');
    }

    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products  = Product::all();
        return view('admin.market.discount.amazingSale-edit', compact('amazingSale', 'products'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazingSale)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realTimestampEnd);
        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'فروش شگفت انگیز شما با موفقیت ویرایش شد');

    }

    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'فروش شگفت انگیز شما با موفقیت حذف شد');
    }
}
