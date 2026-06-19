<?php

namespace App\Filament\Resources\ServiceSteps\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class ServiceStepsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service.name_en') // Assumes Service model has a 'name_en' or 'title' attribute
                    ->label('Service')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('step_number')
                    ->label('Step No.')
                    ->sortable(),

                TextColumn::make('room_number')
                    ->label('Room No.')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('counter_number')
                    ->label('Counter No.')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->searchable(),

                TextColumn::make('title_np')
                    ->label('Title (NP)')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add filters here if needed (e.g., SelectFilter for service_id)
            ])
            ->actions([
                // ViewAction::make(),
                // EditAction::make(),
            ])
            ->bulkActions([
                // // BulkActionGroup::make([
                // //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}