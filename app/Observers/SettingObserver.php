<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingObserver
{
    public function saved(Setting $setting)
    {
        if (in_array($setting->section, ['contact_info', 'social_media'])) {
            $this->clearContactInfoCache();
        }
        $this->clearHomePageCache();
    }

    public function deleted(Setting $setting)
    {
        if (in_array($setting->section, ['contact_info', 'social_media'])) {
            $this->clearContactInfoCache();
        }
        $this->clearHomePageCache();
    }

    protected function clearHomePageCache()
    {
        Cache::flush();
    }

    protected function clearContactInfoCache()
    {
        $pattern = "contact_info_*";
        
        if (config('cache.default') === 'redis') {
            $keys = Cache::getRedis()->keys("*{$pattern}*");
            foreach ($keys as $key) {
                Cache::forget(str_replace(config('cache.prefix'), '', $key));
            }
        } else {
            Cache::forget("contact_info");
        }
    }
}
