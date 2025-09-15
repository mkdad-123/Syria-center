<?php
namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Cache;

class EventObserver
{
    public function saved(Event $event)
    {
        $this->clearEventsCache();
    }

    public function deleted(Event $event)
    {
        $this->clearEventsCache();
    }

    public function updated(Event $event)
    {
        // إذا كان التحديث يتضمن تغيير حالة النشر
        if ($event->isDirty('is_published')) {
            $this->clearEventsCache();
        }
    }

    protected function clearEventsCache()
    {
        // الطريقة الدقيقة لحذف الكاش حسب اللغات
        $locales = ['ar', 'en']; // يمكن جلبها من الإعدادات
        
        foreach ($locales as $locale) {
            $cacheKey = "events_page_{$locale}";
            Cache::forget($cacheKey);
            
            // أو إذا كنت تستخدم الطابع الزمني في المفتاح:
            $pattern = "events_page_{$locale}_*";
            $this->clearCacheByPattern($pattern);
        }
    }

    protected function clearCacheByPattern($pattern)
    {
        // هذه الطريقة تعتمد على نظام التخزين
        // مثال لتنفيذها مع Redis:
        if (config('cache.default') === 'redis') {
            $keys = Cache::getRedis()->keys("*{$pattern}*");
            foreach ($keys as $key) {
                Cache::forget(str_replace(config('cache.prefix'), '', $key));
            }
        }
    }
}