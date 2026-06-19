<?php

namespace App\Filament\Resources\ServiceSteps;

use App\Filament\Resources\ServiceSteps\Pages;
use App\Filament\Resources\ServiceSteps\Schemas\ServiceStepsForm;
use App\Filament\Resources\ServiceSteps\Tables\ServiceStepsTable;
use App\Models\ServiceStep;
use Filament\Schemas\Schema; // Crucial for modern Filament
use Filament\Resources\Resource;
use Filament\Tables\Table;
use BackedEnum;

class ServiceStepsResource extends Resource
{
    protected static ?string $model = ServiceStep::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    // Must accept and return a Schema instance
    public static function form(Schema $schema): Schema
    {
        return ServiceStepsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceStepsTable::configure($table);
    }
    
    public static function getRelations(): array
    {
        return [];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceSteps::route('/'),
            'create' => Pages\CreateServiceSteps::route('/create'),
            'edit' => Pages\EditServiceSteps::route('/{record}/edit'),
        ];
    }    
}