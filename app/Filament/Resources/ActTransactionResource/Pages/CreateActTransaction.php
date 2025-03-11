<?php

namespace App\Filament\Resources\ActTransactionResource\Pages;

use App\Filament\Resources\ActTransactionResource;
use App\Models\Bank;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateActTransaction extends CreateRecord
{
    protected static string $resource = ActTransactionResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function beforeCreate(): void
    {

        $bank = Bank::find($this->data['bank_id']);
        if ($this->data['type'] ==  'CR') {
            $bank->saldo_sekarang = $bank->saldo_sekarang - $this->data['nominal'];
        } else {
            $bank->saldo_sekarang = $bank->saldo_sekarang + $this->data['nominal'];
        }
        $bank->save();
        // dd($bank);

        // Runs after the form fields are saved to the database.
    }
}
