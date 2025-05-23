<?php
namespace App\Observers;

use App\Models\Service;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ServiceDetailsObserver
{
    public function saved(Service $service)
    {
        $this->clearServiceDetailsCache($service->id);
        $this->clearServicesCache($service->section_id);
    }

    public function deleted(Service $service)
    {
        $this->clearServiceDetailsCache($service->id);
        $this->clearServicesCache($service->section_id);
    }
    function clearServiceDetailsCache($serviceId)
{
    $locales = ['ar', 'en']; // اللغات المتاحة
    
    foreach ($locales as $locale) {
        $pattern = "service_details_{$serviceId}_{$locale}_*";
        
        if (config('cache.default') === 'redis') {
            $keys = Cache::getRedis()->keys("*{$pattern}*");
            foreach ($keys as $key) {
                Cache::forget(str_replace(config('cache.prefix'), '', $key));
            }
        } else {
            Cache::forget("service_details_{$serviceId}_{$locale}");
        }
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