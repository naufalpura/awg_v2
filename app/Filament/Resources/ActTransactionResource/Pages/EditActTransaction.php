<?php

namespace App\Filament\Resources\ActTransactionResource\Pages;

use App\Filament\Resources\ActTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActTransaction extends EditRecord
{
    protected static string $resource = ActTransactionResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
