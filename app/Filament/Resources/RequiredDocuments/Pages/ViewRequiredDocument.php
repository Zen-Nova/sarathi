<?php

namespace App\Filament\Resources\RequiredDocuments\Pages;

use App\Filament\Resources\RequiredDocuments\RequiredDocumentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRequiredDocument extends ViewRecord
{
    protected static string $resource = RequiredDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
