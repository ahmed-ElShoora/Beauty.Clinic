<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $doctors = Doctor::get();
        return view('web.doctors',compact('doctors'));
    }
}
