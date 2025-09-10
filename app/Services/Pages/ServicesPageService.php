<?php

namespace App\Services\Pages;

use App\Models\Service;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;

class ServicesPageService implements PageSectionService
{
    public function __construct(private SettingReader $reader) {}

    public function render(string $locale, array $params = []): string
    {
        app()->setLocale($locale);

        $sectionId = (int)($params['section_id'] ?? 0);

        $services = Service::where('section_id', $sectionId)
            ->get()
            ->map(function ($service) use ($locale) {
                return [
                    'id'          => $service->id,
                    'name'        => $this->reader->getTranslatedValue($service->name, $locale),
                    'description' => $this->reader->getTranslatedValue($service->description, $locale),
                    'section_id'  => $service->section_id,
                    'created_at'  => $service->created_at,
                    'updated_at'  => $service->updated_at,
                    'image'       => $service->image
                ];
            });

        return view('services', [
            'services'    => $services,
            'locale'      => $locale,
            'sectionId'   => $sectionId,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact()
        ])->render();
    }
}
