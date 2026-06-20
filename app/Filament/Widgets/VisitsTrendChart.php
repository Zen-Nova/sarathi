<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class VisitsTrendChart extends ChartWidget
{
    protected ?string $heading = 'Daily Citizen Visits (Last 7 Days)';
    
    // Makes the chart span the full width of the dashboard
    protected int | string | array $columnSpan = 1;

    // Removed 'static' keyword here as well
    protected ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        // Loop backward through the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('M d'); // e.g., "Jun 20"
            
            // Count visits for that specific day
            $data[] = Visit::whereDate('entered_at', $date->toDateString())->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Visits',
                    'data' => $data,
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#f59e0b',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}