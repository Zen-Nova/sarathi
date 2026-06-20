<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestFeedbackTable extends BaseWidget
{
    // Added 'static' back here
    protected static ?string $heading = 'Live Citizen Feedback';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Visit::query()
                    ->whereNotNull('citizen_comments')
                    ->latest('exited_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('citizen_name')
                    ->label('Citizen')
                    ->default('Anonymous')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('service.name_en')
                    ->label('Service')
                    ->description(fn (Visit $record) => $record->tracking_token)
                    ->limit(25),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->icon('heroicon-m-star')
                    ->color(fn (string $state): string => match ($state) {
                        '5', '4' => 'success',
                        '3' => 'warning',
                        '2', '1' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('citizen_comments')
                    ->label('Feedback')
                    ->wrap()
                    ->searchable(),
            ])
            ->paginated(false);
    }
}