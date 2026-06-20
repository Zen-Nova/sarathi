<?php

namespace App\Filament\Resources\RequiredDocuments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RequiredDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_id')
                    ->relationship('service', 'name_en')
                    ->required(),
                TextInput::make('title_en')
                    ->required(),
                TextInput::make('title_np')
                    ->required(),
                Textarea::make('description_en'),
                Textarea::make('description_np'),
                Toggle::make('is_required')
                    ->default(true)
                    ->required(),
            ]);
    }
}
