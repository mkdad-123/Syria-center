<?php

namespace App\Services\Dashboard;

use App\Models\Compliants;
use App\Models\CustomUser;
use App\Models\Event;
use App\Models\Volunteer;

class DashboardCountsService
{
    protected static array $cache = [];

    public static function get(string $key): int
    {
        if (empty(self::$cache)) {
            self::$cache = [
                'users' => CustomUser::count(),
                'events' => Event::where('start_date', '>=', now())->count(),
                'volunteers_active' => Volunteer::where('is_active', true)->count(),
                'complaints_today' => Compliants::whereDate('created_at', today())->count(),
            ];
        }

        return self::$cache[$key] ?? 0;
    }
}
