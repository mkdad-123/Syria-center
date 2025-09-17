<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

use App\Http\Controllers\ShowController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CompliantsController;
use App\Http\Controllers\CustomUser\AuhtController;
use App\Http\Controllers\CustomUser\ResetPasswordController;

Route::middleware(['web', \App\Http\Middleware\ForceLocalePrefix::class])->group(function () {

    // الجذر: تحويل سريع إلى اللغة المخزنة أو 'ar'
    Route::get('/', fn() => redirect('/' . (Cookie::get('lang') ?? 'ar')));

    Route::group([
        'prefix'     => '{locale}',
        'where'      => ['locale' => 'ar|en'],
        'middleware' => ['setLocale'],
    ], function () {

        /* صفحات عامة */
        Route::get('/', [ShowController::class, 'showHomePage'])->name('home');
        Route::prefix('home')->group(function () {
            Route::get('/about-us', [ShowController::class, 'showAbout_usPage'])->name('about-us');
        });

        Route::post('/change-language', [LanguageController::class, 'change'])->name('change-language');

        /* Auth (guest) */
        Route::middleware(['guest:custom'])->group(function () {

            // تسجيل الدخول والتسجيل
            Route::get('/login',  [AuhtController::class, 'showLoginForm'])->name('login');
            Route::post('/login', [AuhtController::class, 'login'])->name('login.submit')->middleware('throttle:login');

            Route::get('/register',  [AuhtController::class, 'showRegistrationForm'])->name('register');
            Route::post('/register', [AuhtController::class, 'register'])->name('register.submit');

            // تدفق استعادة كلمة المرور
            // 1) نموذج طلب الكود بالبريد
            Route::view('/reset-request', 'customauth.reset-code')->name('password.request');

            // 2) نموذج إدخال الكود (يتطلب ?email=...)
            Route::get('/verify-code', function (string $locale) {
                if (!request()->has('email')) {
                    return redirect()->route('password.request', ['locale' => $locale]);
                }
                return view('customauth.verify-code');
            })->name('password.verify');

            // 3) نموذج تعيين كلمة المرور (يتطلب ?email=...&token=...)
            Route::get('/reset', function (string $locale) {
                if (!request()->has(['email', 'token'])) {
                    return redirect()->route('password.request', ['locale' => $locale]);
                }
                return view('customauth.reset');
            })->name('password.reset');

            // API endpoints (ترجع JSON عند الطلب عبر fetch، وتعمل redirect للطلب العادي حيثما ينطبق)
            Route::post('/reset-code', [ResetPasswordController::class, 'sendResetCode'])
                ->middleware('throttle:5,1') // 5 محاولات بالدقيقة
                ->name('password.reset-code');

            Route::post('/verify-code', [ResetPasswordController::class, 'verifyResetCode'])
                ->middleware('throttle:10,1')
                ->name('password.verify.post');

            Route::post('/reset', [ResetPasswordController::class, 'resetPassword'])
                ->middleware('throttle:10,1')
                ->name('password.reset.post');
        });

        /* صفحة إشعار التحقق من البريد (عامة) */
        Route::view('/email/verify/notice', 'customauth.verify-notice')->name('verification.notice.public');

        /* داخل تسجيل الدخول */
        Route::middleware('auth:custom')->group(function () {
            Route::prefix('home')->group(function () {
                Route::get('/events',   [ShowController::class, 'showEventsPage'])->name('events');
                // الأقصر أولاً:
                Route::get('/sections', [ShowController::class, 'showSectionsPage'])->name('sections');

                // تفاصيل خدمة (ثابتة الكلمة 'services' بعدها '/{service}/detailes'):
                Route::get('/sections/services/{service}/detailes', [ShowController::class, 'showServicesDetailesPage'])
                    ->whereNumber('service')
                    ->name('details');

                // قائمة خدمات قسم محدد:
                Route::get('/sections/{section}/services', [ShowController::class, 'showServicesPage'])
                    ->whereNumber('section')
                    ->name('services');

                Route::get('/compliants', [ShowController::class, 'showContactInfoPage'])->name('compliants');
                Route::get('/volunteer/{vol?}', [ShowController::class, 'showVolunteerPage'])->name('volunteers');
                Route::get('/article/{id}', [ShowController::class, 'showArticlePage'])
                    ->whereNumber('id')
                    ->name('article.show');
            });

            Route::post('/logout', [AuhtController::class, 'logout'])->name('logout');

            // إعادة إرسال رابط التفعيل
            Route::post('/email/verification-notification', function (Request $request, string $locale) {
                $user = $request->user('custom');

                if ($user->hasVerifiedEmail()) {
                    return redirect()->route('home', ['locale' => $locale]);
                }

                $user->sendEmailVerificationNotification();
                return back()->with('status', 'verification-link-sent');
            })->middleware('throttle:6,1')->name('verification.send');
        });

        /* مسارات تتطلب بريد مُفعّل */
        Route::middleware(['auth:custom', 'verified'])->group(function () {
            Route::post('/compliants', [CompliantsController::class, 'addCompliants'])->name('compliants.store');
        });
    });
});

/* رابط التحقق الموقع خارج {locale} */
Route::get('/verify-email/{id}/{hash}', [AuhtController::class, 'verifyEmailPublic'])
    ->middleware(['web', 'signed', 'throttle:6,1'])
    ->name('verification.verify.public');

/* سويتش لغة اختياري */
Route::get('/lang/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['ar', 'en'], true), 404);
    Cookie::queue(Cookie::make('lang', $locale, 60 * 24 * 365, '/', null, false, false, false, 'Lax'));
    return redirect("/{$locale}");
})->name('lang.switch');
