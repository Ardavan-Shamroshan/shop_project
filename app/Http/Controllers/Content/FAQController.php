<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index() {
        $faqs = Faq::query()->where('status', 1)->get();
        return view('app.content.faq.index', compact('faqs'));
    }
}
