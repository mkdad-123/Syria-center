<?php

namespace App\Services\Pages;

use App\Models\Volunteer;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class VolunteerPageService implements PageSectionService
{
    private CacheService $cache;
    private CacheKeyService $keys;

    public function __construct(
        private SettingReader $reader,
        ?CacheService $cache = null,
        ?CacheKeyService $keys = null
    ) {
        // fallback لو ما تم حقنهم
        $this->cache = $cache ?? app(CacheService::class);
        $this->keys  = $keys  ?? app(CacheKeyService::class);
    }

    public function render(string $locale, array $params = []): string
    {
        // لا نضبط اللغة هنا — SetLocale middleware مسؤول عنها
        $locale = $locale ?: app()->getLocale();
        $id     = (int)($params['volunteer_id'] ?? 0);
        $force  = (bool)($params['refresh'] ?? false);

        abort_if($id <= 0, 404);

        // مفتاح كاش يعتمد المتطوّع + اللغة ويتكسّر تلقائيًا عند تعديل سجلّه
        $key = $this->keys->volunteer($id, $locale);

        $v = $this->cache->remember(
            $key,
            now()->addHours(24),
            fn () => Volunteer::findOrFail($id),
            $force
        );

        $volunteer = [
            'id'            => $v->id,
            'name'          => $this->reader->safeGetTranslation($v, 'name', $locale),
            'email'         => $v->email,
            'phone'         => $v->phone,
            'national_id'   => $v->national_id,
            'birth_date'    => $v->birth_date,
            'gender'        => $this->reader->safeGetTranslation($v, 'gender', $locale),
            'profession'    => $this->reader->safeGetTranslation($v, 'profession', $locale),
            'skills'        => $this->reader->safeGetTranslation($v, 'skills', $locale),
            'availability'  => $this->reader->safeGetTranslation($v, 'availability', $locale),
            'join_date'     => $v->join_date,
            'is_active'     => $v->is_active,
            'profile_photo' => $v->profile_photo,
            'CV'            => $this->reader->safeGetTranslation($v, 'CV', $locale),
            'notes'         => $this->reader->safeGetTranslation($v, 'notes', $locale),
        ];

        return view('volunteer', [
            'volunteer'   => $volunteer,
            'locale'      => $locale,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact(),
        ])->render();
    }
}
