<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Actions\Jetstream\DeleteUser;
use App\Models\Notify\Email;
use Illuminate\Http\Request;
use App\Models\Notify\EmailFile;
use App\Http\Controllers\Controller;
use App\Http\Services\File\FileService;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EmailFileController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Email $email) {
        return view('admin.notify.email-file.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email) {
        return view('admin.notify.email-file.create', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailFileRequest $request, Email $email, FileService $fileService) {
        $inputs = $request->all();
        if ($request->hasFile('file')) {
            if ($inputs['storage_dir'] == 'public') {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
                $fileService->setFileSize($request->file('file'));
                $fileSize = $fileService->getFileSize();
                $result = $fileService->moveToPublic($request->file('file'));
            }
            elseif ($inputs['storage_dir'] == 'storage') {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
                $fileService->setFileSize($request->file('file'));
                $fileSize = $fileService->getFileSize();
                $result = $fileService->moveToStorage($request->file('file'));
            }
            $fileFormat = $fileService->getFileFormat();
            if ($result === false)
                return redirect()->route('admin.notify.email-file.index', $email->id)->with('swal-error', 'آپلود فایل با خطا مواجه شد');
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;
        }
        $inputs['public_mail_id'] = $email->id;
        // dd($inputs);
        EmailFile::query()->create($inputs);
        return redirect()->route('admin.notify.email-file', $email->id)->with('swal-success', 'فایل جدید شما با موفقیت ثبت شد');
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
    public function edit(EmailFile $file) {
        return view('admin.notify.email-file.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailFileRequest $request, EmailFile $file, FileService $fileService) {
        $inputs = $request->all();
        if ($request->hasFile('file')) {
            if (!empty($file->file_path))
                $fileService->deleteFile($file->file_path);
            if ($inputs['storage_dir'] == 'public') {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
                $fileService->setFileSize($request->file('file'));
                $fileSize = $fileService->getFileSize();
                $result = $fileService->moveToPublic($request->file('file'));
            }
            elseif ($inputs['storage_dir'] == 'storage') {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
                $fileService->setFileSize($request->file('file'));
                $fileSize = $fileService->getFileSize();
                $result = $fileService->moveToStorage($request->file('file'));
            }
            $fileFormat = $fileService->getFileFormat();
            if ($result === false)
                return redirect()->route('admin.notify.email-file.index', $file->email->id)->with('swal-error', 'آپلود فایل با خطا مواجه شد');
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;
        }
        elseif ($file->storage_dir !== $inputs['storage_dir'] and $inputs['storage_dir'] === 'storage')
            File::move(public_path($file->file_path), storage_path($file->file_path));
        elseif ($file->storage_dir !== $inputs['storage_dir'] and $inputs['storage_dir'] === 'public')
            File::move(storage_path($file->file_path), public_path($file->file_path));
        $file->update($inputs);
        return redirect()->route('admin.notify.email-file', $file->email->id)->with('swal-success', 'فایل شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailFile $file) {
        $file->delete();
        return redirect(route('admin.notify.email-file', $file->email->id))->with('swal-success', 'فایل ضمیمه با موفقیت حذف شد');
    }

    public function status(EmailFile $file) {
        $file->status = $file->status == 0 ? 1 : 0;
        $result = $file->save();
        if ($result) {
            if ($file->status == 0)
                return response()->json(['status' => true, 'checked' => false]);
            else
                return response()->json(['status' => true, 'checked' => true]);
        }
        else
            return response()->json(['status' => false]);
    }
}
