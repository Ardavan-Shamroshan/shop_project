<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\SlideRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Menu;
use App\Models\Content\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $slides = Slide::all();
        return view('admin.content.slide.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.content.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request, ImageService $imageService) {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'slide');
            $result = $imageService->fitAndSave($request->file('image'), 900, 350);
            if ($result === false)
                return redirect()->route('admin.content.post')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['image'] = $result;
        }
        Slide::query()->create($inputs);
        return redirect(route('admin.content.slide'))->with('swal-success', 'اسلاید شو سایت شما با موفقیت ثبت شد');
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
    public function edit(Slide $slide) {
        return view('admin.content.slide.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlideRequest $request, Slide $slide, ImageService $imageService) {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            if (!empty($slide->image))
                $imageService->deleteImage($slide->image);
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'slide');
            $result = $imageService->fitAndSave($request->file('image'), 900, 350);
            if ($result === false)
                return redirect()->route('admin.content.post')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['image'] = $result;
        }
        $slide->update($inputs);
        return redirect(route('admin.content.slide'))->with('swal-success', 'اسلاید شو سایت شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide) {
        $slide->delete();
        return redirect(route('admin.content.slide'))->with('swal-success', 'اسلاید شو سایت شما با موفقیت حذف شد');
    }

    public function status(Slide $slide) {
        $slide->status = $slide->status == 0 ? 1 : 0;
        $result = $slide->save();
        if ($result) {
            if ($slide->status == 0)
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
