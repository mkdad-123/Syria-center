<?php

namespace App\Services\Pages;

use App\Models\Setting;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;

class AboutUsService implements PageSectionService
{
    public function __construct(private SettingReader $reader) {}

    public function render(string $locale, array $params = []): string
    {
        app()->setLocale($locale);

        $about = Setting::where('section', 'about us')->first();

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
