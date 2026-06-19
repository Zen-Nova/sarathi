<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('department_id')
                    ->relationship('department', 'id')
                    ->required(),
                TextInput::make('name_en')
                    ->required(),
                TextInput::make('name_np')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
