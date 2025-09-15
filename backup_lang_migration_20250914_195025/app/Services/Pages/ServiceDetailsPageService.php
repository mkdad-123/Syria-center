<?php

namespace App\Services\Pages;

use App\Models\Service;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;

class ServiceDetailsPageService implements PageSectionService
{
    public function __construct(private SettingReader $reader) {}

    public function render(string $locale, array $params = []): string
    {
        app()->setLocale($locale);

        $serviceId = (int)($params['service_id'] ?? 0);

        $service = Service::with('articles')->findOrFail($serviceId);

        $translatedService = [
            'id'          => $service->id,
            'name'        => $service->getTranslatedAttribute('name', $locale) ?? $service->name,
            'description' => $service->getTranslatedAttribute('description', $locale) ?? $service->description,
            'section_id'  => $service->section_id,
            'created_at'  => $service->created_at,
            'updated_at'  => $service->updated_at,
            'image'       => $service->image,
            'articles'    => $service->articles->map(function ($article) use ($locale) {
                return [
                    'id'        => $article->id,
                    'title'     => $article->getTranslatedAttribute('title', $locale) ?? $article->title,
                    'content'   => $article->getTranslatedContent($locale),
                    'service_id'=> $article->service_id,
                    'created_at'=> $article->created_at,
                    'updated_at'=> $article->updated_at
                ];
            })
        ];

        return view('servicesdetailes', [
            'service'     => $translatedService,
            'locale'      => $locale,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact()
        ])->render();
    }
}
