<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // 1) تخطَّ مسارات فيلمانت (admin/*)
        if ($request->routeIs('filament.*') || str_starts_with($request->path(), 'admin')) {
            $locale = Cookie::get('lang') ?? config('app.locale', 'ar');
            if (! in_array($locale, ['ar', 'en'], true)) {
                $locale = 'ar';
            }

            app()->setLocale($locale);
            Carbon::setLocale($locale);
            View::share('locale', $locale);
            View::share('dir', $locale === 'ar' ? 'rtl' : 'ltr');

            // لا نغيّر الكوكي هنا (اختياري)
            return $next($request);
        }

        // 2) المنطق العادي لباقي الموقع (مسارات /ar/* و /en/*)
        $routeLocale  = $request->route('locale');
        $cookieLocale = Cookie::get('lang');
        $locale = $routeLocale ?? $cookieLocale ?? 'ar';

        if (! in_array($locale, ['ar', 'en'], true)) {
            $locale = 'ar';
        }

        app()->setLocale($locale);
        Carbon::setLocale($locale);
        View::share('locale', $locale);
        View::share('dir', $locale === 'ar' ? 'rtl' : 'ltr');

        // ثبّت الكوكي لسنة إن تغيّرت
        if ($cookieLocale !== $locale) {
            Cookie::queue(
                Cookie::make('lang', $locale, 60 * 24 * 365, '/', null, false, false, false, 'Lax')
            );
        }

        return $next($request);
    }
}
