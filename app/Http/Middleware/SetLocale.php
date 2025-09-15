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
        $allowed = ['ar','en'];

        // المصدر الوحيد: ?lang= ثم كوكي lang ثم افتراضي ar
        $locale = $request->query('lang') ?? Cookie::get('lang') ?? 'ar';
        if (!in_array($locale, $allowed, true)) {
            $locale = 'ar';
        }

        // لو وصل ?lang= حدّث الكوكي (سنة)
        if ($request->has('lang') && Cookie::get('lang') !== $locale) {
            Cookie::queue(Cookie::make('lang', $locale, 60*24*365, '/', null, false, false, false, 'Lax'));
        }

        app()->setLocale($locale);
        Carbon::setLocale($locale);
        View::share('locale', $locale);
        View::share('dir', $locale === 'ar' ? 'rtl' : 'ltr');

        return $next($request);
    }
}
