<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Doctor;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $cards = Card::get();
        $doctors = Doctor::inRandomOrder()->take(3)->get();
        return view('web.index',compact('cards','doctors'));
    }
}
