<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

use Carbon\Carbon;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $routeLocale = $request->route('locale');
        $cookieLocale = Cookie::get('lang');
        $locale = $routeLocale ?? $cookieLocale ?? 'ar';

        if (! in_array($locale, ['ar', 'en'])) {
            $locale = 'ar';
        }

        app()->setLocale($locale);
        \Carbon\Carbon::setLocale($locale);
        View::share('locale', $locale);
        View::share('dir', $locale === 'ar' ? 'rtl' : 'ltr');

        // ثبّت الكوكي لسنة
        if ($cookieLocale !== $locale) {
            Cookie::queue(Cookie::make('lang', $locale, 60 * 24 * 365, '/', null, false, false, false, 'Lax'));
        }

        return $next($request);
    }
}
