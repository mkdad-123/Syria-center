<?php

namespace App\Services\Pages;

use App\Models\Section;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class SectionsPageService implements PageSectionService
{
    private CacheService $cache;
    private CacheKeyService $keys;

    public function __construct(
        private SettingReader $reader,
        ?CacheService $cache = null,
        ?CacheKeyService $keys = null
    ) {
        // fallback لو ما تم حقنهم من الـ container/AppServiceProvider
        $this->cache = $cache ?? app(CacheService::class);
        $this->keys  = $keys  ?? app(CacheKeyService::class);
    }

    public function render(string $locale, array $params = []): string
    {
        // لا نضبط اللغة هنا — SetLocale middleware مسؤول عنها
        $locale = $locale ?: app()->getLocale();
        $force  = (bool)($params['refresh'] ?? false);

        // مفتاح كاش يعتمد اللغة ويتكسّر تلقائيًا لو تغيّر أي Section/Service
        $key = $this->keys->sections($locale);

        // لاحظ: نقلّل الأعمدة المجلبة قدر الإمكان + eager load للخدمات
        $sections = $this->cache->remember(
            $key,
            now()->addHours(24),
            function () use ($locale) {
                return Section::with(['services:id,section_id,name,description'])
                    ->select('id', 'name', 'description', 'image', 'created_at', 'updated_at')
                    ->get()
                    ->map(function ($section) use ($locale) {
                        return [
                            'id'          => $section->id,
                            'name'        => $this->reader->getTranslatedValue($section->name, $locale),
                            'description' => $this->reader->getTranslatedValue($section->description, $locale),
                            'image'       => $section->image,
                            'services'    => $section->services->map(function ($service) use ($locale) {
                                return [
                                    'id'          => $service->id,
                                    'name'        => $this->reader->getTranslatedValue($service->name, $locale),
                                    'description' => $this->reader->getTranslatedValue($service->description, $locale),
                                ];
                            }),
                            'created_at'  => $section->created_at,
                            'updated_at'  => $section->updated_at,
                        ];
                    });
            },
            $force
        );

        return view('sections', [
            'sections'    => $sections,
            'locale'      => $locale,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact(),
        ])->render();
    }
}
