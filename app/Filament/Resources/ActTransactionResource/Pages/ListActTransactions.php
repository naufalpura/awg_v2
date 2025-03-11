<?php

namespace App\Filament\Resources\ActTransactionResource\Pages;

use App\Filament\Resources\ActTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActTransactions extends ListRecords
{
    protected static string $resource = ActTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
