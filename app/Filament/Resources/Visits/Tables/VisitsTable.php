<?php

namespace App\Filament\Resources\Visits\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

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

                TextColumn::make('department.name_en') // Assumes Department model has 'name_en'
                    ->label('Department')
                    ->numeric()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('service.name_en') // Assumes Service model has 'name_en'
                    ->label('Service')
                    ->numeric()
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

                TextColumn::make('entered_at')
                    ->label('Entered At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('exited_at')
                    ->label('Exited At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('failure_reason')
                    ->label('Failure Reason')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('department_id')
                    ->relationship('department', 'name_en')
                    ->preload()
                    ->searchable(),

                SelectFilter::make('service_id')
                    ->relationship('service', 'name_en')
                    ->preload()
                    ->searchable(),

                TernaryFilter::make('is_completed')
                    ->label('Completion Status'),
            ])
            ->actions([
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