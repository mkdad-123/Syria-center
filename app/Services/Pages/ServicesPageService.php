<?php

namespace App\Services\Pages;

use App\Models\Service;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class ServicesPageService implements PageSectionService
{
    private CacheService $cache;
    private CacheKeyService $keys;

    public function __construct(
        private SettingReader  $reader,
        ?CacheService $cache = null,
        ?CacheKeyService $keys = null
    ) {
        $this->cache = $cache ?? app(CacheService::class);
        $this->keys  = $keys  ?? app(CacheKeyService::class);
    }

    public function render(string $locale, array $params = []): string
    {
        // لا نضبط اللغة هنا؛ الميدلوير مسؤول عنها
        $locale    = $locale ?: app()->getLocale();
        $sectionId = (int)($params['section_id'] ?? 0);
        $force     = (bool)($params['refresh'] ?? false);

        // مفتاح الكاش حسب المنهجية الموجودة عندك (مع timestamp تلقائي)
        $key = $this->keys->servicesList($sectionId, $locale);

        $services = $this->cache->remember(
            $key,
            now()->addHours(24),
            function () use ($sectionId, $locale) {
                return Service::where('section_id', $sectionId)
                    ->get()
                    ->map(function ($service) use ($locale) {
                        return [
                            'id'          => $service->id,
                            'name'        => $this->reader->getTranslatedValue($service->name, $locale),
                            'description' => $this->reader->getTranslatedValue($service->description, $locale),
                            'section_id'  => $service->section_id,
                            'created_at'  => $service->created_at,
                            'updated_at'  => $service->updated_at,
                            'image'       => $service->image,
                        ];
                    });
            },
            $force
        );

        return view('services', [
            'services'    => $services,
            'locale'      => $locale,
            'sectionId'   => $sectionId,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact(),
        ])->render();
    }
}
