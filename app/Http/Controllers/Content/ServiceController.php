<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::query()->where('status', 1)->paginate(6);
        return view('app.content.service.index', compact('services'));
    }

    // public function show($slug) {
    //     $service = Service::query()->where('slug', '=', $slug)->firstOrFail();
    //     return view('app.content.service.show', compact('service'));
    // }
}
