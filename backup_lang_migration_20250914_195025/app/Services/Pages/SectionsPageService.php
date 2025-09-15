<?php

namespace App\Services\Pages;

use App\Models\Section;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;

class SectionsPageService implements PageSectionService
{
    public function __construct(private SettingReader $reader) {}

    public function render(string $locale, array $params = []): string
    {
        app()->setLocale($locale);

        $sections = Section::with('services')
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
                    'updated_at'  => $section->updated_at
                ];
            });

        return view('sections', [
            'sections'    => $sections,
            'locale'      => $locale,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact()
        ])->render();
    }
}
