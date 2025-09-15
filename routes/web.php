<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

use App\Http\Controllers\ShowController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CompliantsController;
use App\Http\Controllers\CustomUser\AuhtController;
use App\Http\Controllers\CustomUser\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Public pages (no auth required)
|--------------------------------------------------------------------------
*/

Route::get('/', [ShowController::class, 'showHomePage'])->name('home');

// صفحات عامة تحت /home
Route::prefix('home')->group(function () {
    Route::get('/about-us',        [ShowController::class, 'showAbout_usPage'])->name('about-us');
    Route::get('/events',          [ShowController::class, 'showEventsPage'])->name('events');
    Route::get('/sections',        [ShowController::class, 'showSectionsPage'])->name('sections');
    Route::get('/sections/{section?}/services', [ShowController::class, 'showServicesPage'])->name('services');
    Route::get('/sections/services/{service?}/detailes', [ShowController::class, 'showServicesDetailesPage'])->name('details');
    Route::get('/compliants',      [ShowController::class, 'showContactInfoPage'])->name('compliants');
    Route::get('/volunteer/{vol?}', [ShowController::class, 'showVolunteerPage'])->name('volunteers');
});

Route::get('/article/{id}', [ShowController::class, 'showArticlePage'])->name('article.show');

// تغيير اللغة
Route::post('/change-language', [LanguageController::class, 'change'])->name('change-language');

/*
|--------------------------------------------------------------------------
| Auth (guest) — login/register/password reset
|--------------------------------------------------------------------------
*/
Route::middleware('guest:custom')->group(function () {
    Route::get('/login',    [AuhtController::class, 'showLoginForm'])->name('login');
    Route::post('/login',   [AuhtController::class, 'login'])->name('login.submit')->middleware('throttle:login');

    Route::get('/register',  [AuhtController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuhtController::class, 'register'])->name('register.submit');

    // Password reset (code → verify → reset)
    Route::view('/reset-request', 'customauth.reset-code')->name('password.request');

    Route::get('/verify-code', function () {
        if (!request()->has('email')) return redirect()->route('password.request');
        return view('customauth.verify-code');
    })->name('password.verify');

    Route::get('/reset', function () {
        if (!request()->has(['email', 'token'])) return redirect()->route('password.request');
        return view('customauth.reset');
    })->name('password.reset');

    Route::post('/reset-code', [ResetPasswordController::class, 'sendResetCode'])->name('password.reset-code');
    Route::post('/verify-code', [ResetPasswordController::class, 'verifyResetCode'])->name('password.verify.post');
    Route::post('/reset',      [ResetPasswordController::class, 'resetPassword'])->name('password.reset.post');
});

/*
|--------------------------------------------------------------------------
| Public Email Verification (no auth required)
|--------------------------------------------------------------------------
| - صفحة إشعار عامة بعد التسجيل
| - رابط تحقق عام موقّع
*/
Route::view('/email/verify/notice', 'customauth.verify-notice')
    ->name('verification.notice.public');

Route::get('/verify-email/{id}/{hash}', [AuhtController::class, 'verifyEmailPublic'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify.public');

/*
|--------------------------------------------------------------------------
| Authenticated (auth:custom) — lightweight actions
|--------------------------------------------------------------------------
*/
Route::middleware('auth:custom')->group(function () {
    Route::post('/logout', [AuhtController::class, 'logout'])->name('logout');

    // إعادة إرسال رابط التفعيل (لمن هو مسجّل دخول لكنه غير مفعّل)
    Route::post('/email/verification-notification', function (Request $request) {
        $user = $request->user('custom');

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $user->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware('throttle:6,1')->name('verification.send');
});

/*
|--------------------------------------------------------------------------
| Routes that require verified email
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:custom', 'verified'])->group(function () {
    // مثال: إرسال الشكاوى يتطلب بريدًا مفعلاً
    Route::post('/compliants', [CompliantsController::class, 'addCompliants'])->name('compliants.store');

    // ضع هنا أي مسارات حسّاسة أخرى (لوحات تحكم، بروفايل، ...).
});

/*
|--------------------------------------------------------------------------
| Language switch (GET)
|--------------------------------------------------------------------------
*/
Route::get('/lang/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['ar', 'en'], true), 404);

    Cookie::queue(Cookie::make('lang', $locale, 60 * 24 * 365, '/', null, false, false, false, 'Lax'));
    app()->setLocale($locale);

    return back();
})->name('lang.switch');
