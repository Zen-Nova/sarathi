<?php

namespace App\Filament\Resources\Visits\Tables;

use App\Models\Visit;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VisitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tracking_token')
                    ->label('Token')
                    ->searchable()
                    ->copyable()
                    ->sortable(),

                TextColumn::make('department.name_en')
                    ->label('Department')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('service.name_en')
                    ->label('Service')
                    ->sortable()
                    ->searchable(),

                IconColumn::make('is_completed')
                    ->label('Completed')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->placeholder('N/A'),

                TextColumn::make('failure_reason')
                    ->label('Issue')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'missing_doc' => 'Missing Documents',
                        'server_down' => 'Server Down',
                        'long_queue' => 'Long Queue',
                        'visit_tomorrow' => 'Visit Another Day',
                        'staff_unhelpful' => 'Staff Behavior',
                        'bribe_request' => 'Bribery / Middlemen',
                        'other' => 'Other',
                        default => 'No Issue',
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'bribe_request' => 'danger',
                        'server_down' => 'warning',
                        'long_queue' => 'warning',
                        'staff_unhelpful' => 'warning',
                        'missing_doc' => 'info',
                        'visit_tomorrow' => 'gray',
                        'other' => 'gray',
                        default => 'success',
                    })
                    ->searchable()
                    ->sortable(),

                IconColumn::make('alert_acknowledged_at')
                    ->label('Reviewed')
                    ->boolean()
                    ->state(fn (Visit $record): bool => filled($record->alert_acknowledged_at))
                    ->trueIcon('heroicon-m-check-circle')
                    ->falseIcon('heroicon-m-exclamation-triangle')
                    ->trueColor('success')
                    ->falseColor(fn (Visit $record): string => $record->failure_reason === 'bribe_request' ? 'danger' : 'gray')
                    ->sortable(),

                TextColumn::make('entered_at')
                    ->label('Entered At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('exited_at')
                    ->label('Exited At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('citizen_comments')
                    ->label('Comments')
                    ->limit(40)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('admin_notes')
                    ->label('Admin Notes')
                    ->limit(40)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('department_id')
                    ->label('Department')
                    ->relationship('department', 'name_en')
                    ->preload()
                    ->searchable(),

                SelectFilter::make('service_id')
                    ->label('Service')
                    ->relationship('service', 'name_en')
                    ->preload()
                    ->searchable(),

                TernaryFilter::make('is_completed')
                    ->label('Completion Status'),

                SelectFilter::make('failure_reason')
                    ->label('Issue Type')
                    ->options([
                        'missing_doc' => 'Missing Documents',
                        'server_down' => 'Server Down',
                        'long_queue' => 'Long Queue',
                        'visit_tomorrow' => 'Visit Another Day',
                        'staff_unhelpful' => 'Staff Behavior',
                        'bribe_request' => 'Bribery / Middlemen',
                        'other' => 'Other',
                    ]),

                Filter::make('bribery_alerts')
                    ->label('Bribery / Middlemen Alerts')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('failure_reason', 'bribe_request')),

                Filter::make('unreviewed_bribery_alerts')
                    ->label('Unreviewed Bribery Alerts')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('failure_reason', 'bribe_request')
                        ->whereNull('alert_acknowledged_at')),
            ])
            ->actions([
                Action::make('markReviewed')
                    ->label('Mark Reviewed')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->visible(fn (Visit $record): bool => $record->failure_reason === 'bribe_request'
                        && is_null($record->alert_acknowledged_at))
                    ->requiresConfirmation()
                    ->action(function (Visit $record): void {
                        $record->update([
                            'alert_acknowledged_at' => now(),
                        ]);
                    }),

                // ViewAction::make(),
                // EditAction::make(),
            ])
            ->bulkActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}