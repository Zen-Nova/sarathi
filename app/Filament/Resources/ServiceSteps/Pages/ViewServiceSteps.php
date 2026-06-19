<?php

namespace App\Filament\Resources\ServiceSteps\Pages;

use App\Filament\Resources\ServiceSteps\ServiceStepsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceSteps extends ViewRecord
{
    protected static string $resource = ServiceStepsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
