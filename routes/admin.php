<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DoctorsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ScheduleController;

//admin login routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware('auth:admin')->name('admin.')->group(function () {
    //admin dashboard route
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    //admin logout route
    Route::get('/logout', [AuthController::class, 'logout']);
    //admin crud routes
    Route::get('/admins',[AdminController::class,'index'])->name('admins');
    Route::get('/admin-delete-{id}',[AdminController::class,'delete'])->name('admin.delete');
    Route::get('/admin-create',[AdminController::class,'create'])->name('create.admin');
    Route::post('/admin-create',[AdminController::class,'store'])->name('create.admin.store');
    //card crud routes
    Route::resource('cards', CardController::class)->except(['show']);
    //services crud routes
    Route::resource('services', ServiceController::class)->except(['show']);
    //doctors crud routes
    Route::resource('doctors', DoctorsController::class)->except(['show']);
    //contacts routes
    Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');
    Route::post('/contact/hide', [ContactController::class, 'hideContact'])->name('contacts.hide');
    //setting routes
    Route::get('/setting',[SettingController::class,'index'])->name('setting');
    Route::post('/setting',[SettingController::class,'update'])->name('setting.update');
    //schedule routes
    Route::get('/schedule',[ScheduleController::class,'index'])->name('schedule');
    Route::post('/schedule',[ScheduleController::class,'update'])->name('schedule.update');
});