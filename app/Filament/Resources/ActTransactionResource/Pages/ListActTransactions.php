<?php

namespace App\Filament\Resources\ActTransactionResource\Pages;

use App\Models\Bank;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ActTransactionResource;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use App\Filament\Resources\ActTransactionResource\Widgets\TransactionOverview;

class ListActTransactions extends ListRecords
{
    protected static string $resource = ActTransactionResource::class;
    // protected ?string $maxContentWidth = 'full';
    protected function getHeaderWidgets(): array
    {
        return [
            TransactionOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {

        $banks = Bank::all();
        $bankTab = [];

        $bankTab[] = Tab::make('All Income');
        foreach ($banks as $bank) {
            $bankTab[] = Tab::make($bank->name)
                ->modifyQueryUsing(fn(Builder $query) => $query->where('bank_id', $bank->id));
        }

        return $bankTab;
    }
}
