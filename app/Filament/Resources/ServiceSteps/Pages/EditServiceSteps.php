<?php

namespace App\Filament\Resources\ServiceSteps\Pages;

use App\Filament\Resources\ServiceSteps\ServiceStepsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceSteps extends EditRecord
{
    protected static string $resource = ServiceStepsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
