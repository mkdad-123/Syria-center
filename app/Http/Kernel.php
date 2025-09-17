<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Global middleware
    protected $middleware = [
        \Illuminate\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    // Middleware groups
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // ⬅ قبل StartSession
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            // اختياري: إن أردت تشغيل SetLocale تلقائياً لكل web
            // \App\Http\Middleware\SetLocale::class,
        ],

        'api' => [
            'throttle:api', // ⬅ أصلح هذا السطر
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    // Aliases (المستحسن في Laravel 12)
    protected $middlewareAliases = [
        'auth'       => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can'        => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'      => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
        'signed'     => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'   => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'forceLocalePrefix' => \App\Http\Middleware\ForceLocalePrefix::class,

        'setLocale'   => \App\Http\Middleware\SetLocale::class, // ✅
        'custom.auth' => \App\Http\Middleware\CustomAuthenticate::class,
        'cacheResponse' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
    ];
}
