<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::query()->first();
        if($setting == null) {
            $result = new SettingSeeder();
            $result->run();
            $setting = Setting::query()->first();
        }
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $ImageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')) {
            if (!empty($setting->logo))
                $ImageService->deleteImage($setting->logo);
            $ImageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $ImageService->setImageName('logo');
            $result = $ImageService->save($request->file('logo'));
            if ($result === false)
                return redirect()->route('admin.content.setting')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['logo'] = $result;
        }
        if ($request->hasFile('icon')) {
            if (!empty($setting->icon))
                $ImageService->deleteImage($setting->icon);
            $ImageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $ImageService->setImageName('icon');
            $result = $ImageService->save($request->file('icon'));
            if ($result === false)
                return redirect()->route('admin.content.setting')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['icon'] = $result;
        }
        $setting->update($inputs);
        return redirect(route('admin.setting'))->with('swal-success', 'تنظیمات سایت شما با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
