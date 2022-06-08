<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\QuickLinkRequest;
use App\Models\Content\Post;
use App\Models\Content\QuickLink;
use Illuminate\Http\Request;

class QuickLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quickLinks = QuickLink::all();
        return view('admin.content.quick-link.index', compact('quickLinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.quick-link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuickLinkRequest $request)
    {
        $inputs = $request->all();
        QuickLink::query()->create($inputs);
        return redirect(route('admin.content.quickLink'))->with('swal-success', 'لینک سریع جدید با موفقیت ثبت شد ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(QuickLink $quickLink)
    {
        return view('admin.content.quick-link.edit',compact('quickLink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuickLinkRequest $request, QuickLink $quickLink)
    {
        $inputs = $request->all();
        $quickLink->update($inputs);
        return redirect(route('admin.content.quickLink'))->with('swal-success', 'لینک سریع شما با موفقیت ویرایش شد ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuickLink $quickLink)
    {
        $quickLink->delete();
        return redirect(route('admin.content.quickLink'))->with('swal-success', 'لینک سریع شما با موفقیت حذف شد ');
    }

    public function status(QuickLink $quickLink) {
        $quickLink->status = $quickLink->status == 0 ? 1 : 0;
        $result = $quickLink->save();
        if ($result) {
            if ($quickLink->status == 0)
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            else
                return response()->json([
                    'status' => true,
                    'checked' => true,
                ]);
        }
        else
            return response()->json(['status' => false]);
    }
}
