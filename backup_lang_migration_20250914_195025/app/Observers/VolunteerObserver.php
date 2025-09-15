<?php

namespace App\Observers;

use App\Models\Volunteer;
use Illuminate\Support\Facades\Cache;

class VolunteerObserver
{
    public function saved(Volunteer $volunteer)
    {
        $this->clearHomePageCache();
         $this->clearVolunteerCache($volunteer->id);
    }

    public function deleted(Volunteer $volunteer)
    {
        $this->clearHomePageCache();
        $this->clearVolunteerCache($volunteer->id);

    }

    protected function clearHomePageCache()
    {
        Cache::flush();
    }
     protected function clearVolunteerCache($volunteerId)
      {
        $locales = ['ar', 'en'];
        
        foreach ($locales as $locale) {
            $pattern = "volunteer_{$volunteerId}_{$locale}_*";
            
            if (config('cache.default') === 'redis') {
                $keys = Cache::getRedis()->keys("*{$pattern}*");
                foreach ($keys as $key) {
                    Cache::forget(str_replace(config('cache.prefix'), '', $key));
                }
            } else {
                Cache::forget("volunteer_{$volunteerId}_{$locale}");
            }
        }
    }
}