<?php

namespace App\Services\Pages;

use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;

class ContactPageService implements PageSectionService
{
    public function __construct(private SettingReader $reader) {}

    public function render(string $locale, array $params = []): string
    {
        app()->setLocale($locale);

        $contactInfo = $this->reader->contact();
        $socialMedia = $this->reader->social();

        $contactData = [
            'phones'        => array_merge($contactInfo['phones'] ?? [], $contactInfo['mobile_numbers'] ?? []),
            'emails'        => $contactInfo['emails'] ?? [],
            'address'       => $contactInfo['address'] ?? null,
            'working_hours' => $contactInfo['working_hours'] ?? null
        ];

        $socialData = [
            'facebook' => $socialMedia['facebook'] ?? null,
            'twitter'  => $socialMedia['twitter']  ?? null,
            'linkedin' => $socialMedia['linkedin'] ?? null,
            'instagram'=> $socialMedia['instagram']?? null,
            'youtube'  => $socialMedia['youtube']  ?? null
        ];

        return view('compliants', [
            'contactInfo' => $contactData,
            'socialMedia' => $socialData
        ])->render();
    }
}
