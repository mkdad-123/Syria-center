<?php

namespace App\Services\Pages;

use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class ContactPageService implements PageSectionService
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
        // لا نضبط اللغة هنا — SetLocale middleware مسؤول عنها
        $locale = $locale ?: app()->getLocale();
        $force  = (bool)($params['refresh'] ?? false);

        // مفتاح الكاش الأساسي من CacheKeyService + لاحقة اللغة لتجنّب خلط الترجمات
        $key = $this->keys->contact() . "_{$locale}";

        $payload = $this->cache->remember(
            $key,
            now()->addHours(24),
            function () use ($locale) {
                $contactInfo = $this->reader->contact(); // يفترض أنه يرجّع القيم مترجمة عند الحاجة
                $socialMedia = $this->reader->social();

                $contactData = [
                    'phones'        => array_merge($contactInfo['phones'] ?? [], $contactInfo['mobile_numbers'] ?? []),
                    'emails'        => $contactInfo['emails'] ?? [],
                    'address'       => $contactInfo['address'] ?? null,
                    'working_hours' => $contactInfo['working_hours'] ?? null,
                ];

                $socialData = [
                    'facebook' => $socialMedia['facebook']  ?? null,
                    'twitter'  => $socialMedia['twitter']   ?? null,
                    'linkedin' => $socialMedia['linkedin']  ?? null,
                    'instagram'=> $socialMedia['instagram'] ?? null,
                    'youtube'  => $socialMedia['youtube']   ?? null,
                ];

                return compact('contactData', 'socialData');
            },
            $force
        );

        return view('compliants', [
            'contactInfo' => $payload['contactData'],
            'socialMedia' => $payload['socialData'],
        ])->render();
    }
}
