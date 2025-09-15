<?php

// app/Services/Cache/CacheService.php
namespace App\Services\Cache;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class CacheService
{
    public function remember(string $key, $ttl, Closure $callback, bool $forceRefresh = false)
    {
        if ($forceRefresh) {
            Cache::forget($key);
        }

        // الحل: لا نستخدم الكاش إذا المستخدم مسجّل
        if (Auth::guard('custom')->check()) {
            return $callback();
        }

        return Cache::remember($key, $ttl, $callback);
    }
}
