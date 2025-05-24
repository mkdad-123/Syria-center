<?php

namespace App\Filament\Widgets;

use App\Models\Volunteer;
use App\Models\Event;
use App\Models\CustomUser;
use App\Models\Compliants;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';
    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        $volunteerTrend = $this->getVolunteerTrend();
        $userTrend = $this->getUserTrend();
        $eventTrend = $this->getEventTrend();

        return [
            Stat::make(__('widgets.active_volunteers'), Volunteer::where('is_active', true)->count())
                ->description($this->getTrendDescription($volunteerTrend))
                ->descriptionIcon($this->getTrendIcon($volunteerTrend))
                ->chart($this->getTrendValues($volunteerTrend))
                ->color($this->getTrendColor($volunteerTrend)),

            Stat::make(__('widgets.registered_users'), CustomUser::count())
                ->description($this->getTrendDescription($userTrend))
                ->descriptionIcon($this->getTrendIcon($userTrend))
                ->chart($this->getTrendValues($userTrend))
                ->color($this->getTrendColor($userTrend)),

            Stat::make(__('widgets.upcoming_events'), Event::where('start_date', '>', now())->count())
                ->description($this->getTrendDescription($eventTrend))
                ->descriptionIcon($this->getTrendIcon($eventTrend))
                ->chart($this->getTrendValues($eventTrend))
                ->color($this->getTrendColor($eventTrend)),

            Stat::make(__('widgets.services_provided'), Service::count())
                ->description(__('widgets.includes_all_sections'))
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make(__('widgets.recent_complaints'), Compliants::whereDate('created_at', '>', now()->subDays(7))->count())
                ->description(__('widgets.last_7_days'))
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('danger'),
        ];
    }

    protected function getTrendDescription($data): string
    {
        $current = $data[count($data)-1]->aggregate;
        $previous = $data[count($data)-2]->aggregate;

        $change = $previous != 0
            ? round((($current - $previous) / $previous) * 100, 2)
            : 100;

        return $change >= 0
            ? __('widgets.increase', ['value' => abs($change)])
            : __('widgets.decrease', ['value' => abs($change)]);
    }

    protected function getVolunteerTrend()
    {
        return Trend::model(Volunteer::class)
            ->between(
                start: now()->subMonths(3),
                end: now(),
            )
            ->perMonth()
            ->count();
    }

    protected function getUserTrend()
    {
        return Trend::model(CustomUser::class)
            ->between(
                start: now()->subMonths(3),
                end: now(),
            )
            ->perMonth()
            ->count();
    }

    protected function getEventTrend()
    {
        return Trend::model(Event::class)
            ->between(
                start: now()->subMonths(3),
                end: now(),
            )
            ->perMonth()
            ->count();
    }


    protected function getTrendIcon($data): string
    {
        $current = $data[count($data)-1]->aggregate;
        $previous = $data[count($data)-2]->aggregate;

        return $current >= $previous ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
    }

    protected function getTrendColor($data): string
    {
        $current = $data[count($data)-1]->aggregate;
        $previous = $data[count($data)-2]->aggregate;

        return $current >= $previous ? 'success' : 'danger';
    }

    protected function getTrendValues($data): array
    {
        return collect($data)->map(fn (TrendValue $value) => $value->aggregate)->toArray();
    }
}
