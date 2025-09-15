<?php

namespace App\Services\Pages;

use App\Models\Service;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class ServiceDetailsPageService implements PageSectionService
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
        $locale    = $locale ?: app()->getLocale();
        $serviceId = (int)($params['service_id'] ?? 0);
        $force     = (bool)($params['refresh'] ?? false);

        abort_if($serviceId <= 0, 404);

        // مفتاح كاش: يعتمد الخدمة + اللغة ويتكسّر تلقائيًا عند تعديل الخدمة أو مقالاتها
        $key = $this->keys->serviceDetails($serviceId, $locale);

        $servicePayload = $this->cache->remember(
            $key,
            now()->addHours(24),
            function () use ($serviceId, $locale) {
                $service = Service::with(['articles' => fn($q) => $q->orderByDesc('id')])
                    ->findOrFail($serviceId);

                return [
                    'id'          => $service->id,
                    'name'        => $service->getTranslatedAttribute('name', $locale) ?? $service->name,
                    'description' => $service->getTranslatedAttribute('description', $locale) ?? $service->description,
                    'section_id'  => $service->section_id,
                    'created_at'  => $service->created_at,
                    'updated_at'  => $service->updated_at,
                    'image'       => $service->image,
                    'articles'    => $service->articles->map(function ($article) use ($locale) {
                        return [
                            'id'         => $article->id,
                            'title'      => $article->getTranslatedAttribute('title', $locale) ?? $article->title,
                            'content'    => $article->getTranslatedContent($locale),
                            'service_id' => $article->service_id,
                            'created_at' => $article->created_at,
                            'updated_at' => $article->updated_at,
                            'image'      => $article->image ?? null,
                        ];
                    })->all(),
                ];
            },
            $force
        );

        return view('servicesdetailes', [
            'service'     => $servicePayload,
            'locale'      => $locale,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact(),
        ])->render();
    }
}
