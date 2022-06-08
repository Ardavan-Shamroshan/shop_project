<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Notifications\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::query()->where('user_type', 0)->get();
        return view('admin.user.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.user.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, ImageService $imageService) {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false)
                return redirect()->route('admin.user')->with('swal-error', 'آپلود پروفایل با خطا مواجه شد');
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 0;
        User::query()->create($inputs);
        // Notification
        $details = [
            'message' => ' کاربر "' .  $inputs['first_name'] .' '. $inputs['last_name'] . '" در سایت ثبت نام کرد '
        ];
        $adminUser = User::query()->find(1);
        $adminUser->notify(new NewUserRegistered($details));
        return redirect()->route('admin.user')->with('swal-success', 'کاربر جدید با موفقیت ثبت شد');
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
    public function edit(User $user) {
        return view('admin.user.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, ImageService $imageService) {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {
            if (!empty($user->profile_photo_path))
                $imageService->deleteImage($user->profile_photo_path);
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false)
                return redirect()->route('admin.user')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['profile_photo_path'] = $result;
        }
        $user->update($inputs);
        $details = [
            'message' => ' کاربر "' .  $inputs['first_name'] .' '. $inputs['last_name'] . '" پروفایل خود را ویرایش کرد '
        ];
        $adminUser = User::query()->find(1);
        $adminUser->notify(new NewUserRegistered($details));
        return redirect()->route('admin.user')->with('swal-success', 'کاربر سایت شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $user->forceDelete();
        return redirect(route('admin.user'))->with('swal-success', 'کاربر با موفقیت حذف شد');
    }

    public function status(User $user) {
        $user->status = $user->status == 0 ? 1 : 0;
        $result = $user->save();
        if ($result) {
            if ($user->status == 0)
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            elseif ($user->status == 1)
                return response()->json([
                    'status' => true,
                    'checked' => true,
                ]);
        }
        else
            return response()->json([
                'status' => false,
            ]);
    }

    public function activation(User $user) {
        if ($user->activation == 0) {
            $user->activation = 1;
            $user->activation_date = now();
        } else $user->activation = 0;
        $result = $user->save();
        if ($result) {
            if ($user->activation == 0)
                return response()->json([
                    'activation' => true,
                    'checked' => false,
                ]);
            elseif ($user->activation == 1)
                return response()->json([
                    'activation' => true,
                    'checked' => true,
                ]);
        }
        else
            return response()->json([
                'status' => false,
            ]);
    }
}
