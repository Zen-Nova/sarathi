<?php

namespace App\Filament\Resources\RequiredDocuments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;

class RequiredDocumentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('service.name_en')
                    ->label('Service'),
                TextEntry::make('title_en'),
                TextEntry::make('title_np'),
                TextEntry::make('description_en'),
                TextEntry::make('description_np'),
                IconEntry::make('is_required')
                    ->boolean(),
            ]);
    }
}
