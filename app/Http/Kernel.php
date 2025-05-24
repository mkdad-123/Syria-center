<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \Illuminate\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    protected $middlewareGroups = [
     'web' => [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,        // 1. تشفير الكوكيز أولاً
        \Illuminate\Session\Middleware\StartSession::class,         // 2. بدء الجلسة (تعتمد على الكوكيز)
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,  // 3. مشاركة الأخطاء من الجلسة
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // 4. إضافة الكوكيز للرد
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,    // 5. التحقق من CSRF
        \Illuminate\Routing\Middleware\SubstituteBindings::class,   // 6. ربط النماذج (مثل Route Model Binding)
        \App\Http\Middleware\SetLocale::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class,     // 8. الحد من الطلبات (يأتي لاحقاً)
    ],
        'api' => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'custom.auth' => \App\Http\Middleware\CustomAuthenticate::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'cacheResponse' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
        'setlocale' => \App\Http\Middleware\SetLocale::class,


    ];
}
