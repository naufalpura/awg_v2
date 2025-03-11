<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacketUmrohResource\Pages;
use App\Filament\Resources\PacketUmrohResource\RelationManagers;
use App\Models\PacketUmroh;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacketUmrohResource extends Resource
{
    protected static ?string $model = PacketUmroh::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Paket Umroh';
    protected static ?string $modelLabel = 'Paket Umroh';
    // protected static ?string $navigationGroup = 'Content';
    protected static ?string $slug = 'paket-umroh';
    protected static ?string $pluralLabel = 'Paket Umroh';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama Paket'),
                DatePicker::make('schedule')->label('Jadwal Keberangkatan'),
                TextInput::make('price')->label('Harga')->numeric()->inputMode('decimal'),
                TextInput::make('dp')->label('DP')->numeric()->inputMode('decimal'),
                Toggle::make('status')->default(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('schedule'),
                TextColumn::make('price')->money('IDR'),
                TextColumn::make('dp')->money('IDR'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePacketUmrohs::route('/'),
        ];
    }
}
