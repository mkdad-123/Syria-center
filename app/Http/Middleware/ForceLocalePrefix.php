<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ForceLocalePrefix
{
    /**
     * يفرض بادئة اللغة لمسارات الموقع العامة فقط،
     * ويستثني مسارات/ملفات لوحة التحكم والأصول والـ APIs.
     */
    public function handle(Request $request, Closure $next)
    {
        $firstSegment = $request->segment(1) ?? '';
        $path         = ltrim($request->path(), '/');

        // 1) استثناءات لا يجب أن تُعاد توجيهها
        $excludedFirstSegments = [
            'admin',        // فيلمانت
            'filament',     // أصول فيلمانت
            'api',          // REST APIs
            'livewire',     // أصول Livewire
            'vendor',       // أصول باكج
            'storage', 'build', 'assets',
            'horizon', 'telescope', 'nova',
        ];

        $excludedExactPaths = [
            'favicon.ico', 'robots.txt', 'sitemap.xml',
            'artisan-run.php', 'check-db.php',
        ];

        $excludedExtensions = [
            'css','js','map',
            'png','jpg','jpeg','webp','svg','gif','ico',
            'woff','woff2','ttf','eot','otf',
        ];

        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $shouldSkip =
            $request->routeIs('filament.*') ||
            $request->is('admin*') ||
            $request->is('api/*') ||
            $request->is('livewire/*') ||
            $request->is('vendor/*') ||
            $request->is('storage/*') ||
            $request->is('build/*') ||
            $request->is('assets/*') ||
            in_array($firstSegment, $excludedFirstSegments, true) ||
            in_array($path, $excludedExactPaths, true) ||
            ($ext && in_array(strtolower($ext), $excludedExtensions, true));

        if ($shouldSkip) {
            return $next($request);
        }

        // 2) لو المسار يبدأ فعلاً بـ ar|en نكمل عادي
        if (in_array($firstSegment, ['ar', 'en'], true)) {
            return $next($request);
        }

        // 3) حدِّد اللغة (من الكوكي أو الافتراضي)
        $locale = $request->cookie('lang') ?? config('app.locale', 'ar');
        if (! in_array($locale, ['ar', 'en'], true)) {
            $locale = 'ar';
        }

        // 4) ابنِ عنوان التحويل مع الحفاظ على الاستعلامات
        $target = '/' . $locale . ($path ? '/' . $path : '');
        if ($query = $request->getQueryString()) {
            $target .= '?' . $query;
        }

        return redirect()->to($target, 302);
    }
}
