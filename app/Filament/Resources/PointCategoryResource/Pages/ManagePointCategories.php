<?php

namespace App\Filament\Resources\PointCategoryResource\Pages;

use App\Filament\Resources\PointCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePointCategories extends ManageRecords
{
    protected static string $resource = PointCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
