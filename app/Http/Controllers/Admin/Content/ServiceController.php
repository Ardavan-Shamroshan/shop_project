<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\ServiceRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $services = Service::all();
        return view('admin.content.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.content.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request, ImageService $imageService) {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'service');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false)
                return redirect()->route('admin.content.service')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['image'] = $result;
        }
        Service::query()->create($inputs);
        return redirect(route('admin.content.service'))->with('swal-success', 'خدمت جدید شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service) {
        return view('admin.content.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service, ImageService $imageService) {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            if (!empty($service->image))
                $imageService->deleteDirectoryAndFiles($service->image['directory']);
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'service');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false)
                return redirect()->route('admin.content.service')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['image'] = $result;
        }
        $service->slug = null;
        $service->update($inputs);
        return redirect(route('admin.content.service'))->with('swal-success', 'خدمت جدید شما با ویرایش ثبت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service) {
        $service->delete();
        return redirect(route('admin.content.service'))->with('swal-success', 'خدمت با موفقیت حذف شد');
    }

    public function status(Service $service) {
        $service->status = $service->status == 0 ? 1 : 0;
        $result = $service->save();
        if ($result) {
            if ($service->status == 0)
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
