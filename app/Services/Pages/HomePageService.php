<?php

namespace App\Services\Pages;

use App\Models\Partner;
use App\Models\Volunteer;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;

class HomePageService implements PageSectionService
{
    public function __construct(private SettingReader $reader) {}

    public function render(string $locale, array $params = []): string
    {
        app()->setLocale($locale);

        $team = Volunteer::all()->map(fn($m) => [
            'id'    => $m->id,
            'name'  => $this->reader->safeGetTranslation($m, 'name',  $locale),
            'skills'=> $this->reader->safeGetTranslation($m, 'skills',$locale),
            'bio'   => $this->reader->safeGetTranslation($m, 'notes', $locale),
            'image' => $m->profile_photo ?? 'default-member.jpg',
        ]);

        $partners = Partner::all()->map(fn($p) => [
            'id'          => $p->id,
            'name'        => $this->reader->safeGetTranslation($p, 'name', $locale),
            'description' => $this->reader->safeGetTranslation($p, 'description', $locale),
            'image'       => $p->image ?? 'default-partner.jpg',
        ]);

        return view('welcome', [
            'locale'      => $locale,
            'aboutUs'     => $this->reader->sectionContent('about us', $locale),
            'targetgroup' => $this->reader->sectionContent('target group', $locale),
            'message'     => $this->reader->sectionContent('mission', $locale),
            'vision'      => $this->reader->sectionContent('vision', $locale),
            'team'        => $team,
            'partners'    => $partners,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact(),
        ])->render();
    }
}
