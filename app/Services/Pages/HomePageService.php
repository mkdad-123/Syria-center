<?php

namespace App\Services\Pages;

use App\Models\Partner;
use App\Models\Volunteer;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class HomePageService implements PageSectionService
{
    private CacheService $cache;
    private CacheKeyService $keys;

    public function __construct(
        private SettingReader $reader,
        ?CacheService $cache = null,          // اجعلها اختيارية
        ?CacheKeyService $keys = null         // اجعلها اختيارية
    ) {
        // لو ما تم حقنها من الـ container، نجيبها يدويًا
        $this->cache = $cache ?? app(CacheService::class);
        $this->keys  = $keys  ?? app(CacheKeyService::class);
    }

    public function render(string $locale, array $params = []): string
    {
        $locale = $locale ?: app()->getLocale();
        $force  = (bool)($params['refresh'] ?? false);

        $key = $this->keys->home($locale);

        return $this->cache->remember(
            $key,
            now()->addHours(24),
            function () use ($locale) {
                $teamRaw     = Volunteer::latest()->get();
                $partnersRaw = Partner::latest()->get();

                $team = $teamRaw->map(function ($m) use ($locale) {
                    return [
                        'id'     => $m->id,
                        'name'   => $this->reader->safeGetTranslation($m, 'name',  $locale),
                        'skills' => $this->reader->safeGetTranslation($m, 'skills', $locale),
                        'bio'    => $this->reader->safeGetTranslation($m, 'notes',  $locale),
                        'image'  => $m->profile_photo ?? 'default-member.jpg',
                    ];
                });

                $partners = $partnersRaw->map(function ($p) use ($locale) {
                    return [
                        'id'          => $p->id,
                        'name'        => $this->reader->safeGetTranslation($p, 'name', $locale),
                        'description' => $this->reader->safeGetTranslation($p, 'description', $locale),
                        'image'       => $p->image ?? 'default-partner.jpg',
                    ];
                });

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
            },
            $force
        );
    }
}
