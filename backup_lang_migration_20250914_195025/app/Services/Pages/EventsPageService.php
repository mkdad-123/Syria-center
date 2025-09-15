<?php

namespace App\Services\Pages;

use App\Models\Event;
use App\Services\Contracts\PageSectionService;
use App\Services\Support\SettingReader;

class EventsPageService implements PageSectionService
{
    public function __construct(private SettingReader $reader) {}

    public function render(string $locale, array $params = []): string
    {
        app()->setLocale($locale);

        $events = Event::where('is_published', '1')
            ->orderByDesc('id')
            ->get()
            ->map(function ($event) {
                return [
                    'id'               => $event->id,
                    'title'            => $event->title,
                    'description'      => $event->description,
                    'type'             => $event->type,
                    'start_date'       => $event->start_date,
                    'end_date'         => $event->end_date,
                    'location'         => $event->location,
                    'max_participants' => $event->max_participants,
                    'cover_image'      => $event->cover_image,
                    'created_at'       => $event->created_at,
                    'updated_at'       => $event->updated_at
                ];
            });

        return view('events', [
            'events'      => $events,
            'locale'      => $locale,
            'socialMedia' => $this->reader->social(),
            'contactInfo' => $this->reader->contact()
        ])->render();
    }
}
