<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class BottleneckServicesTable extends BaseWidget
{
    // Added 'static' back here
    protected static ?string $heading = 'Service Bottleneck Tracker';
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Service::query()->with('visits')
            )
            ->columns([
                Tables\Columns\TextColumn::make('department.name_en')
                    ->label('Department')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('name_en')
                    ->label('Service Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('avg_processing_time')
                    ->label('Avg. Wait Time')
                    ->getStateUsing(function (Service $record) {
                        $completedVisits = $record->visits()
                            ->where('is_completed', true)
                            ->whereNotNull('entered_at')
                            ->whereNotNull('exited_at')
                            ->get();

                        if ($completedVisits->isEmpty()) {
                            return 'N/A';
                        }

                        $avgMinutes = $completedVisits->avg(function ($visit) {
                            return $visit->entered_at->diffInMinutes($visit->exited_at);
                        });

                        return number_format($avgMinutes, 0) . ' mins';
                    })
                    ->badge()
                    ->color(function (string $state): string {
                        if ($state === 'N/A') return 'gray';
                        $minutes = (int) $state;
                        
                        if ($minutes > 45) return 'danger';
                        if ($minutes > 30) return 'warning';
                        return 'success';
                    }),
            ])
            ->defaultSort('name_en', 'asc')
            ->paginated(false);
    }
}