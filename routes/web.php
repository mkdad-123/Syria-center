<?php

use App\Http\Controllers\CompliantsController;
use App\Http\Controllers\CustomUser\AuhtController;
use App\Http\Controllers\CustomUser\ResetPasswordController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CustomAuthenticate;

// الصفحة الرئيسية متاحة للجميع
Route::get('/', [ShowController::class, 'showHomePage'])->name('home');

// مسارات المصادقة (لا تتطلب تسجيل دخول)
Route::middleware('guest:custom')->group(function () {
    Route::post('/change-language', [LanguageController::class, 'change'])->name('change-language');
    Route::get('/login', [AuhtController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuhtController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuhtController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuhtController::class, 'register'])->name('register.submit');
    
    // مسارات استعادة كلمة المرور
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
    
    Route::post('/reset-code', [ResetPasswordController::class, 'sendResetCode'])->name('password.reset-code');
    Route::post('/verify-code', [ResetPasswordController::class, 'verifyResetCode']);
    Route::post('/reset', [ResetPasswordController::class, 'resetPassword']);
});

// المسارات التي تتطلب تسجيل دخول
Route::middleware(CustomAuthenticate::class)->group(function () {
    Route::post('/logout', [AuhtController::class, 'logout'])->name('logout');
    
    // المسارات المحمية
    Route::get('/home/about-us', [ShowController::class, 'showAbout_usPage'])->name('about-us');
    Route::get('/home/events', [ShowController::class, 'showEventsPage'])->name('events');
    Route::get('/home/sections', [ShowController::class, 'showSectionsPage'])->name('sections');
    Route::get('/home/sections/{section?}/services', [ShowController::class, 'showServicesPage'])->name('services');
    Route::get('/home/sections/services/{service?}/detailes', [ShowController::class, 'showServicesDetailesPage'])->name('details');
    Route::get('/home/sections/services/detailes/{article?}/content', [ShowController::class, 'showArticlePage'])->name('article');
    Route::get('/home/compliants', [ShowController::class, 'showContactInfoPage'])->name('compliants');
    Route::get('/home/volunteer/{vol?}', [ShowController::class, 'showVolunteerPage'])->name('volunteers');
    
    Route::post('/compliants', [CompliantsController::class, 'addCompliants'])->name('compliants.store');
});