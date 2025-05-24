<?php
namespace App\Observers;

use App\Models\Section;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;
class ServiceObserver
{
    public function saved(Service $service)
    {
        $this->clearServicesCache($service->section_id);
    }

    public function deleted(Service $service)
    {
        $this->clearServicesCache($service->section_id);
    }

    public function updated(Service $service)
    {
        if ($service->isDirty('section_id')) {
            $this->clearServicesCache($service->getOriginal('section_id'));
            $this->clearServicesCache($service->section_id);
        }
    }

    protected function clearServicesCache($sectionId)
    {
        $locales = ['ar', 'en']; // اللغات المتاحة
        
        foreach ($locales as $locale) {
            $pattern = "services_page_{$sectionId}_{$locale}_*";
            
            if (config('cache.default') === 'redis') {
                $keys = Cache::getRedis()->keys("*{$pattern}*");
                foreach ($keys as $key) {
                    Cache::forget(str_replace(config('cache.prefix'), '', $key));
                }
            } else {
                Cache::forget("services_page_{$sectionId}_{$locale}");
            }
        }
    }
}