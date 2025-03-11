<?php

namespace App\Filament\Resources\PacketUmrohResource\Pages;

use App\Filament\Resources\PacketUmrohResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePacketUmrohs extends ManageRecords
{
    protected static string $resource = PacketUmrohResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
