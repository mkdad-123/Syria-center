<?php

use App\Http\Controllers\CustomUser\AuhtController;
use App\Http\Controllers\CustomUser\ResetPasswordController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShowController::class , 'showHomePage'])->name('home');
Route::get('/home/about-us', [ShowController::class , 'showAbout_usPage'])->name('about-us');
Route::get('/home/events', [ShowController::class , 'showEventsPage'])->name('events');
Route::get('/home/sections', [ShowController::class , 'showSectionsPage'])->name('sections');
Route::get('/home/sections/{section?}/services', [ShowController::class , 'showServicesPage'])->name('services');
Route::get('/home/sections/services/{service?}/detailes',[ShowController::class , 'showServicesDetailesPage'])->name('details');
Route::get('/home/sections/services/detailes/{article?}/content',[ShowController::class , 'showArticlePage'])->name('article');





Route::get('/login', [AuhtController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuhtController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuhtController::class, 'logout'])->name('logout');

Route::get('/register', [AuhtController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuhtController::class, 'register'])->name('register.submit');

    Route::post('/reset-code', [ResetPasswordController::class, 'sendResetCode'])->name('password.reset-code');
    Route::post('/verify-code', [ResetPasswordController::class, 'verifyResetCode']);
    Route::post('/reset', [ResetPasswordController::class, 'resetPassword']);


    Route::get('/reset-request', function () {
        return view('customauth.reset-code');
    })->name('password.request');

    Route::get('/verify-code', function () {
        if (!request()->has('email')) {
            return redirect()->route('password.request');
        }
        return view('customauth.verify-code');
    })->name('password.verify');

    Route::get('/reset', function () {
        if (!request()->has('email') || !request()->has('token')) {
            return redirect()->route('password.request');
        }
        return view('customauth.reset');
    })->name('password.reset');


