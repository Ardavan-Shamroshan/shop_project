<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\Notify\Email;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::query()->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.notify.email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        $inputs                 = $request->all();
        $realTimestampStart     = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        Email::query()->create($inputs);
        return redirect(route('admin.notify.email'))->with('swal-success', 'ایمیل شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        return view('admin.notify.email.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailRequest $request, Email $email)
    {
        $inputs                 = $request->all();
        $realTimestampStart     = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)$realTimestampStart);
        $email->update($inputs);
        return redirect(route('admin.notify.email'))->with('swal-success', 'ایمیل شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();
        return redirect(route('admin.notify.email'))->with('swal-success', 'ایمیل با موفقیت حذف شد');
    }


    public function status(Email $email)
    {
        $email->status = $email->status == 0 ? 1 : 0;
        $result        = $email->save();
        if ($result) {
            if ($email->status == 0)
                return response()->json([
                    'status'  => true,
                    'checked' => false,
                ]);
            else return response()->json([
                'status'  => true,
                'checked' => true,
            ]);
        } else return response()->json([
            'status' => false,
        ]);
    }

    public function send(Email $email)
    {
        $emailService = new EmailService();
        $emailService->setDetails([
            'title' => $email->subject,
            'body'  => $email->body
        ]);
        $emailService->setFrom('noreply@example.com', 'example');
        $emailService->setSubject($email->subject);
        $emailService->setTo('raphael2000r@gmail.com');

        $messagesService = new MessageService($emailService);
        $messagesService->send();
        return redirect()->back()->with('swal-success', 'با موفقیت ارسال شد');
    }
}
