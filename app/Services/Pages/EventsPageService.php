<?php

namespace App\Services\Pages;

use App\Models\Event;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheKeyService;

class EventsPageService implements PageSectionService
{
    private CacheService $cache;
    private CacheKeyService $keys;

    public function __construct(
        private SettingReader $reader,
        ?CacheService $cache = null,
        ?CacheKeyService $keys = null
    ) {
        // fallback لو ما تم حقنهم من الـ container
        $this->cache = $cache ?? app(CacheService::class);
        $this->keys  = $keys  ?? app(CacheKeyService::class);
    }

    public function render(string $locale, array $params = []): string
    {
        // لا نضبط اللغة هنا — الميدلوير SetLocale مسؤول
        $locale = $locale ?: app()->getLocale();
        $force  = (bool)($params['refresh'] ?? false);

        // مفتاح كاش يعتمد اللغة ويتكسّر تلقائيًا لو تغيّرت الأحداث المنشورة
        $key = $this->keys->events($locale);

        $events = $this->cache->remember(
            $key,
            now()->addHours(24),
            function () {
                return Event::where('is_published', '1')
                    ->orderByDesc('id')
                    ->get()
                    ->map(function ($event) {
                        return [
                            'id'               => $event->id,
                            'title'            => $event->title,        // إن كانت مترجمة: استبدل بطريقة الترجمة عندك
                            'description'      => $event->description,  // إن كانت مترجمة: استبدل بطريقة الترجمة عندك
                            'type'             => $event->type,
                            'start_date'       => $event->start_date,
                            'end_date'         => $event->end_date,
                            'location'         => $event->location,
                            'max_participants' => $event->max_participants,
                            'cover_image'      => $event->cover_image,
                            'created_at'       => $event->created_at,
                            'updated_at'       => $event->updated_at,
                        ];
                    });
            },
            $force
        );

        return view('events', [
            'events'      => $events,
            'locale'      => $locale,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact(),
        ])->render();
    }
}
