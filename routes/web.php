<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';

use App\Http\Controllers\Web\ContactUsController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\DoctorController;

Route::get('/', function() {
    return view('web.index');
});

Route::get('/services-web', ServiceController::class);
Route::get('/doctors-web', DoctorController::class);

Route::get('/contact-us', [ContactUsController::class, 'contcat']);
Route::post('/contact-us', [ContactUsController::class, 'store']);