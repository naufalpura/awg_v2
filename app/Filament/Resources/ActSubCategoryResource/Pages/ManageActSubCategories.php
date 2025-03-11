<?php

namespace App\Filament\Resources\ActSubCategoryResource\Pages;

use App\Filament\Resources\ActSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageActSubCategories extends ManageRecords
{
    protected static string $resource = ActSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
