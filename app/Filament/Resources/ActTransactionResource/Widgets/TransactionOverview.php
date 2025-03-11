<?php

namespace App\Filament\Resources\ActTransactionResource\Widgets;

use App\Models\Bank;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $banks = Bank::all();
        $stats = [];

        $stats[] = Stat::make('Total Saldo', number_format(Bank::sum('saldo_sekarang')));
        foreach ($banks as $bank) {
            $stats[] = Stat::make($bank->name, number_format($bank->saldo_sekarang));
        }
        return $stats;
    }
}
