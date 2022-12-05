<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $admins = User::query()->where('user_type', 1)->get();
        return view('admin.user.admin-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request, ImageService $imageService) {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false)
                return redirect()->route('admin.user.admin-user')->with('swal-error', 'آپلود پروفایل با خطا مواجه شد');
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;
        User::query()->create($inputs);
        return redirect()->route('admin.user.admin-user')->with('swal-success', 'ادمین جدید با موفقیت ثبت شد');
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
    public function edit(User $admin) {
        return view('admin.user.admin-user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, User $admin, ImageService $imageService) {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {
            if (!empty($admin->profile_photo_path))
                $imageService->deleteImage($admin->profile_photo_path);
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false)
                return redirect()->route('admin.user.admin-user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            $inputs['profile_photo_path'] = $result;
        }
        $admin->update($inputs);
        return redirect()->route('admin.user.admin-user')->with('swal-success', 'ادمین سایت شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin) {
        $admin->forceDelete();
        return redirect(route('admin.user.admin-user'))->with('swal-success', 'ادمین با موفقیت حذف شد');
    }

    public function status(User $admin) {
        $admin->status = $admin->status == 0 ? 1 : 0;
        $result = $admin->save();
        if ($result) {
            if ($admin->status == 0)
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            elseif ($admin->status == 1)
                return response()->json([
                    'status' => true,
                    'checked' => true,
                ]);
        } else
            return response()->json([
                'status' => false,
            ]);
    }

    public function activation(User $admin) {
        if ($admin->activation == 0) {
            $admin->activation = 1;
            $admin->activation_date = now();
        } else $admin->activation = 0;
        $result = $admin->save();
        if ($result) {
            if ($admin->activation == 0)
                return response()->json([
                    'activation' => true,
                    'checked' => false,
                ]);
            elseif ($admin->activation == 1)
                return response()->json([
                    'activation' => true,
                    'checked' => true,
                ]);
        } else
            return response()->json([
                'status' => false,
            ]);
    }

    public function roles(User $admin) {
        $roles = Role::all();
        return view('admin.user.admin-user.roles', compact('admin', 'roles'));
    }

    public function rolesStore(Request $request, User $admin) {
        $validated = $request->validate([
            'roles' => ['nullable', 'exists:roles,id', 'array'],
        ]);
        $admin->roles()->sync($request->roles);
        return redirect()->route('admin.user.admin-user')->with('swal-success', 'نقش با موفقیت اختصاص داده شد');
    }

    public function permissions(User $admin) {
        $permissions = Permission::all();
        return view('admin.user.admin-user.permissions', compact('admin', 'permissions'));
    }

    public function permissionsStore(Request $request, User $admin) {
        $validated = $request->validate([
            'permissions' => ['nullable', 'exists:permissions,id', 'array'],
        ]);
        $admin->permissions()->sync($request->permissions);
        return redirect()->route('admin.user.admin-user')->with('swal-success', 'نقش با موفقیت اختصاص داده شد');
    }
}
