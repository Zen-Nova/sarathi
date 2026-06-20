<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BriberyAlertWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $unreviewedCount = Visit::query()
            ->where('failure_reason', 'bribe_request')
            ->whereNull('alert_acknowledged_at')
            ->count();

        $totalCount = Visit::query()
            ->where('failure_reason', 'bribe_request')
            ->count();

        return [
            Stat::make('Unreviewed Bribery / Middlemen Alerts', $unreviewedCount)
                ->description('Needs immediate admin review')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($unreviewedCount > 0 ? 'danger' : 'success'),

            Stat::make('Total Bribery / Middlemen Reports', $totalCount)
                ->description('All-time flagged reports')
                ->descriptionIcon('heroicon-m-shield-exclamation')
                ->color('warning'),
        ];
    }
}