<?php

namespace App\Services\Pages;

use App\Models\Setting;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class AboutUsService implements PageSectionService
{
    private CacheService $cache;
    private CacheKeyService $keys;

    public function __construct(
        private SettingReader $reader,
        ?CacheService $cache = null,
        ?CacheKeyService $keys = null
    ) {
        // fallback لو ما تم حقنهم في AppServiceProvider
        $this->cache = $cache ?? app(CacheService::class);
        $this->keys  = $keys  ?? app(CacheKeyService::class);
    }

    public function render(string $locale, array $params = []): string
    {
        // لا نضبط اللغة هنا — الميدلوير مسؤول عنها
        $locale = $locale ?: app()->getLocale();
        $force  = (bool)($params['refresh'] ?? false);

        // مفتاح كاش يعتمد اللغة ويتغيّر تلقائياً عند تعديل محتوى "about us"
        $key = $this->keys->about($locale);

        $about = $this->cache->remember(
            $key,
            now()->addHours(24),
            fn () => Setting::where('section', 'about us')->first(),
            $force
        );

        if (!$about) {
            return view('about-us', [
                'locale'      => $locale,
                'aboutUs'     => "",
                'socialMedia' => [],
                'contactInfo' => [],
                'image'       => "",
            ])->render();
        }

        return view('about-us', [
            'locale'      => $locale,
            'aboutUs'     => $this->reader->getSafeContent($about, $locale),
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact(),
            'image'       => $about->image,
        ])->render();
    }
}
