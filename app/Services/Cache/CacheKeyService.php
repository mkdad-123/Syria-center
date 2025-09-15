<?php

namespace App\Services\Cache;

use App\Models\{Setting, Volunteer, Partner, Event, Section, Service, Article};
use Illuminate\Support\Carbon;

class CacheKeyService
{
    private function toCarbon($v): ?Carbon
    {
        if (!$v) return null;
        return $v instanceof Carbon ? $v : Carbon::parse($v);
    }

    public function home(string $locale): string
    {
        $last = collect([
            Setting::max('updated_at'),
            Volunteer::max('updated_at'),
            Partner::max('updated_at'),
        ])->filter()->map(fn($d) => $this->toCarbon($d))->max();

        $key = "home_page_{$locale}";
        return $last ? "{$key}_{$last->timestamp}" : $key;
    }

    // ملاحظة: نحافظ على اختلافك الأصلي (about-us في الكي، about us في الجلب)
    public function about(string $locale): string
    {
        $last = $this->toCarbon(Setting::where('section', 'about us')->max('updated_at'));
        $key  = "about_us_page_{$locale}";
        return $last ? "{$key}_{$last->timestamp}" : $key;
    }

    public function events(string $locale): string
    {
        $last = $this->toCarbon(Event::where('is_published', '1')->max('updated_at'));
        $key  = "events_page_{$locale}";
        return $last ? "{$key}_{$last->timestamp}" : $key;
    }

    public function sections(string $locale): string
    {
        $last = $this->toCarbon(max(Section::max('updated_at'), Service::max('updated_at')));
        $key  = "sections_page_{$locale}";
        return $last ? "{$key}_{$last->timestamp}" : $key;
    }

    public function servicesList(int $sectionId, string $locale): string
    {
        $last = $this->toCarbon(Service::where('section_id', $sectionId)->max('updated_at'));
        $key  = "services_page_{$sectionId}_{$locale}";
        return $last ? "{$key}_{$last->timestamp}" : $key;
    }

    public function serviceDetails(int $serviceId, string $locale): string
    {
        $last = $this->toCarbon(max(
            Service::where('id', $serviceId)->value('updated_at'),
            Article::where('service_id', $serviceId)->max('updated_at')
        ));
        $key = "service_details_{$serviceId}_{$locale}";
        return $last ? "{$key}_{$last->timestamp}" : $key;
    }

    public function article(int $articleId): string
    {
        $last = $this->toCarbon(Article::where('id', $articleId)->value('updated_at'));
        $key  = "article_{$articleId}";
        return $last ? "{$key}_{$last->timestamp}" : $key;
    }

    public function contact(): string
    {
        $last = $this->toCarbon(Setting::whereIn('section', ['about us'])->max('updated_at'));
        return $last ? "contact_info_{$last->timestamp}" : "contact_info";
    }
    public function volunteer(int $volunteerId, string $locale): string
    {
        $lastModified = Volunteer::where('id', $volunteerId)->value('updated_at');
        $key = "volunteer_{$volunteerId}_{$locale}";

        if ($lastModified) {
            $ts = Carbon::parse($lastModified)->timestamp;
            return "{$key}_{$ts}";
        }
        return $key;
    }
}
