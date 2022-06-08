<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactRequest;
use App\Models\Contact\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {
    public function contact() {
        return view('app.contact.index');
    }

    public function storeContact(ContactRequest $request) {
        // $inputs = $request->all();
        // //  Send mail to admin
        // Mail::send('app.contact.mail', array (
        //     'first_name' => $inputs['first_name'],
        //     'last_name' => $inputs['last_name'],
        //     'email' => $inputs['email'],
        //     'mobile' => $inputs['mobile'],
        //     'subject' => $inputs['subject'],
        //     'message' => $inputs['message'],
        // ), function ($message) use ($request) {
        //     $message->from($request->email);
        //     $message->to('ardavan2000.ashr@gmail.com')->subject($request->get('subject'));
        // });
        // Contact::query()->create($inputs);
        // return redirect()->back()->with(['swal-success' => 'Contact Form Submit Successfully']);
    }
}
