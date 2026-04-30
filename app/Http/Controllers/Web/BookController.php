<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;

class BookController extends Controller
{
    public function index(){
        $services = Service::all()->map(function ($service) {
            $service->icon_url = asset('storage/'.$service->icon);
            return $service;
        });
        return view('web.book',compact('services'));
    }
}
