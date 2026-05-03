<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/admin.php';

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\ContactUsController;
use App\Http\Controllers\Web\DoctorController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ServiceController;

Route::get('/', HomeController::class);

Route::get('/services-web', ServiceController::class);
Route::get('/doctors-web', DoctorController::class);

Route::get('/contact-us', [ContactUsController::class, 'contcat']);
Route::post('/contact-us', [ContactUsController::class, 'store']);

Route::get('/book-appointment', [BookController::class, 'index']);
Route::post('/book-appointment', [BookController::class, 'store']);
