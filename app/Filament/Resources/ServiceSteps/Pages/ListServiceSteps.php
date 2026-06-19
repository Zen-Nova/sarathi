<?php

namespace App\Filament\Resources\ServiceSteps\Pages;

use App\Filament\Resources\ServiceSteps\ServiceStepsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceSteps extends ListRecords
{
    protected static string $resource = ServiceStepsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
