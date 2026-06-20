<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class DashboardStatsOverview extends BaseWidget
{
    // Refreshes the stats every 15 seconds automatically (Removed 'static' keyword)
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        // 1. Calculate Total Visits Today
        $visitsToday = Visit::whereDate('entered_at', Carbon::today())->count();

        // 2. Calculate Average Processing Time (Only for completed visits)
        $completedVisits = Visit::where('is_completed', true)
            ->whereNotNull('entered_at')
            ->whereNotNull('exited_at')
            ->get();

        $averageMinutes = 0;
        if ($completedVisits->count() > 0) {
            $averageMinutes = $completedVisits->avg(function ($visit) {
                return $visit->entered_at->diffInMinutes($visit->exited_at);
            });
        }

        // 3. Calculate Citizen Satisfaction (Average Rating)
        $averageRating = Visit::whereNotNull('rating')->avg('rating') ?? 0;

        return [
            Stat::make('Total Visits (Today)', $visitsToday)
                ->description('Citizens processed today')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Avg. Processing Time', number_format($averageMinutes, 0) . ' mins')
                ->description('From entry to exit (completed only)')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Citizen Satisfaction', number_format($averageRating, 1) . ' / 5.0')
                ->description('Average feedback rating')
                ->descriptionIcon('heroicon-m-star')
                ->color('primary'),
        ];
    }
}