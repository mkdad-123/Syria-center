<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        // 1. التحقق من وجود معلمة lang في URL
        if ($request->has('lang')) {
            $locale = $request->query('lang');
            \App::setLocale($locale);
            return $next($request)->cookie('preferred_language', $locale, 60 * 24 * 30);
        }

        // 2. التحقق من وجود كوكي preferred_language
        if ($request->hasCookie('preferred_language')) {
            $locale = $request->cookie('preferred_language');
            \App::setLocale($locale);
            return $next($request);
        }

        // 3. استخدام اللغة الافتراضية
        \App::setLocale(config('app.fallback_locale'));
        return $next($request);
    }
}
