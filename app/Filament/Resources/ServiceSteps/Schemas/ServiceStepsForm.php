<?php

namespace App\Filament\Resources\ServiceSteps\Schemas;

use Filament\Schemas\Schema; 
// Form fields remain here:
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
// Layout containers have moved here:
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class ServiceStepsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service Step Details')
                    ->schema([
                        Select::make('service_id')
                            ->relationship('service', 'name_en')
                            ->label('Service')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('step_number')
                                    ->label('Step No.')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('room_number')
                                    ->label('Room No.'),

                                TextInput::make('counter_number')
                                    ->label('Counter No.'),
                            ]),

                        TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->required(),

                        TextInput::make('title_np')
                            ->label('Title (NP)'),
                    ])
            ]);
    }
}