<?php

namespace App\Filament\Resources\Visits\Schemas;

use Filament\Schemas\Schema;
// Form elements remain here
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
// Layout containers move here
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class VisitsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        // Left/Main Panel (Takes 2/3 width)
                        Section::make('Visit Information')
                            ->schema([
                                TextInput::make('tracking_token')
                                    ->label('Tracking Token')
                                    ->required()
                                    ->maxLength(255)
                                    ->default(fn () => 'TRK-' . strtoupper(uniqid())),

                                Grid::make(2)
                                    ->schema([
                                        Select::make('department_id')
                                            ->relationship('department', 'name_en')
                                            ->label('Department')
                                            ->preload()
                                            ->searchable()
                                            ->required(),

                                        Select::make('service_id')
                                            ->relationship('service', 'name_en')
                                            ->label('Service')
                                            ->preload()
                                            ->searchable()
                                            ->required(),
                                    ]),

                                // NEW: Added optional Citizen Contact Details (nested 2-column layout)
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('citizen_name')
                                            ->label('Citizen Name (Optional)')
                                            ->maxLength(255),

                                        TextInput::make('citizen_phone')
                                            ->label('Phone Number (Optional)')
                                            ->tel() // Enforces a telephone format client-side
                                            ->maxLength(20),
                                    ]),

                                Textarea::make('citizen_comments')
                                    ->label('Citizen Comments')
                                    ->rows(4)
                                    ->columnSpanFull(),

                                Textarea::make('failure_reason')
                                    ->label('Failure Reason')
                                    ->rows(2)
                                    ->columnSpanFull()
                                    ->placeholder('State why the visit failed, if applicable.'),
                            ])
                            ->columnSpan(2),

                        // Right/Sidebar Panel (Takes 1/3 width)
                        Section::make('Status & Metrics')
                            ->schema([
                                Toggle::make('is_completed')
                                    ->label('Is Completed')
                                    ->inline(false)
                                    ->required(),

                                TextInput::make('rating')
                                    ->label('Rating (1-5)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(5)
                                    ->placeholder('Unrated'),

                                DateTimePicker::make('entered_at')
                                    ->label('Entered At')
                                    ->required()
                                    ->default(now()),

                                DateTimePicker::make('exited_at')
                                    ->label('Exited At'),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}