<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ForceLocalePrefix
{
    /**
     * يفرض وجود بادئة لغة في كل المسارات العامة (/ar أو /en).
     * إن لم توجد، يعيد التوجيه لنفس المسار مع البادئة المناسبة مع الحفاظ على Query String.
     */
    public function handle(Request $request, Closure $next)
    {
        $firstSegment = $request->segment(1);

        // لو المسار يبدأ فعلاً بـ ar|en نكمل عادي
        if (in_array($firstSegment, ['ar', 'en'], true)) {
            return $next($request);
        }

        // حدّد اللغة المطلوبة (من الكوكي إن وجدت، وإلا الافتراضي ar)
        $locale = $request->cookie('lang') ?? app()->getLocale() ?? 'ar';
        if (!in_array($locale, ['ar', 'en'], true)) {
            $locale = 'ar';
        }

        // ابنِ المسار المطلوب: /{locale}/{path-without-leading-slash}
        $path = ltrim($request->getPathInfo(), '/'); // بدون السلاش الأول
        $target = '/' . $locale . ($path ? '/' . $path : '');

        // أرفق الاستعلامات إن وُجدت (?a=1&b=2)
        if ($query = $request->getQueryString()) {
            $target .= '?' . $query;
        }

        // 302 Redirect (مؤقّت) — كافٍ لحالتنا
        return redirect()->to($target, 302);
    }
}
