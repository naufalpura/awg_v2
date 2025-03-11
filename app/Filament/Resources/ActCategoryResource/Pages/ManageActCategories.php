<?php

namespace App\Filament\Resources\ActCategoryResource\Pages;

use App\Filament\Resources\ActCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageActCategories extends ManageRecords
{
    protected static string $resource = ActCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
