<?php
namespace App\Observers;

use App\Models\Section;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class SectionObserver
{
    public function saved(Section $section)
    {
        $this->clearSectionsCache();
    }

    public function deleted(Section $section)
    {
        $this->clearSectionsCache();
    }
    function clearSectionsCache()
{
    $locales = ['ar', 'en']; // اللغات المتاحة
    
    foreach ($locales as $locale) {
        $pattern = "sections_page_{$locale}_*";
        
        if (config('cache.default') === 'redis') {
            $keys = Cache::getRedis()->keys("*{$pattern}*");
            foreach ($keys as $key) {
                Cache::forget(str_replace(config('cache.prefix'), '', $key));
            }
        } else {
            Cache::forget("sections_page_{$locale}");
        }
    }
}
}