<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ActTransaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ActTransactionResource\Pages;
use App\Filament\Resources\ActTransactionResource\RelationManagers;
use App\Models\ActCategory;

class ActTransactionResource extends Resource
{
    protected static ?string $model = ActTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Transaction';
    protected static ?string $modelLabel = 'Transaction';
    // protected static ?string $navigationGroup = 'Content';
    protected static ?string $slug = 'transaction';
    protected static ?string $pluralLabel = 'Transaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')
                    ->required(),
                Select::make('act_category')->label('Kategori')
                    ->options(ActCategory::all()->pluck('name', 'id')),
                Select::make('act_sub_category_id')->label('Sub Kategori')
                    ->relationship('subCategory', 'name'),
                TextInput::make('description')->label('Deskripsi')
                    ->maxLength(255),
                Select::make('bank_id')
                    ->relationship('bank', 'name')
                    ->required(),
                TextInput::make('nominal')
                    ->required()
                    ->numeric(),
                Select::make('type')
                    ->options([
                        'CR' => 'Pengeluaran',
                        'DB' => 'Pemasukan',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('act_sub_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActTransactions::route('/'),
            'create' => Pages\CreateActTransaction::route('/create'),
            'edit' => Pages\EditActTransaction::route('/{record}/edit'),
        ];
    }
}
