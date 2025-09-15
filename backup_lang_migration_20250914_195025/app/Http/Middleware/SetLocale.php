<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class SetLocale
{
    public function handle($request, \Closure $next)
    {
        $allowed = ['ar', 'en'];

        // ترحيل قديم: لو عندك preferred_language انقله لمرة واحدة
        if (\Cookie::has('preferred_language') && !\Cookie::has('lang')) {
            $prev = \Cookie::get('preferred_language');
            if (in_array($prev, $allowed)) {
                \Cookie::queue(\Cookie::make('lang', $prev, 60 * 24 * 365));
            }
            // احذف الكوكي القديمة
            \Cookie::queue(\Cookie::forget('preferred_language'));
        }

        // أولوية تحديد اللغة: ?lang= → ثم كوكي lang → افتراضي ar
        $locale = $request->query('lang') ?? \Cookie::get('lang') ?? 'ar';
        if (!in_array($locale, $allowed)) {
            $locale = 'ar';
        }

        // لو جاء ?lang= حدّث الكوكي فورًا (لسنة)
        if ($request->has('lang') && \Cookie::get('lang') !== $locale) {
            \Cookie::queue(\Cookie::make('lang', $locale, 60 * 24 * 365));
        }

        app()->setLocale($locale);
        \Carbon\Carbon::setLocale($locale);
        config(['translatable.locale' => $locale]); // إن كنت تستخدم Spatie

        // مشاركة قيم جاهزة للواجهات (اختياري)
        \View::share('locale', $locale);
        \View::share('dir', $locale === 'ar' ? 'rtl' : 'ltr');

        return $next($request);
    }
}
