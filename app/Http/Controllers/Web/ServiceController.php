<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $services = Service::get();
        return view('web.services',compact('services'));
    }
}
