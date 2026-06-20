<?php

namespace App\Filament\Resources\RequiredDocuments;

use App\Filament\Resources\RequiredDocuments\Pages\CreateRequiredDocument;
use App\Filament\Resources\RequiredDocuments\Pages\EditRequiredDocument;
use App\Filament\Resources\RequiredDocuments\Pages\ListRequiredDocuments;
use App\Filament\Resources\RequiredDocuments\Pages\ViewRequiredDocument;
use App\Filament\Resources\RequiredDocuments\Schemas\RequiredDocumentForm;
use App\Filament\Resources\RequiredDocuments\Schemas\RequiredDocumentInfolist;
use App\Filament\Resources\RequiredDocuments\Tables\RequiredDocumentsTable;
use App\Models\RequiredDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RequiredDocumentResource extends Resource
{
    protected static ?string $model = RequiredDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'title_en';

    public static function form(Schema $schema): Schema
    {
        return RequiredDocumentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RequiredDocumentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RequiredDocumentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRequiredDocuments::route('/'),
            'create' => CreateRequiredDocument::route('/create'),
            'view' => ViewRequiredDocument::route('/{record}'),
            'edit' => EditRequiredDocument::route('/{record}/edit'),
        ];
    }
}
