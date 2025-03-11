<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Agen;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AgenResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgenResource\RelationManagers;

class AgenResource extends Resource
{
    protected static ?string $model = Agen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Agen';
    protected static ?string $modelLabel = 'Agen';
    // protected static ?string $navigationGroup = 'Content';
    protected static ?string $slug = 'agen';
    protected static ?string $pluralLabel = 'Agen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('mitra_id')
                    ->relationship('mitra', 'name')
                    ->required(),
                TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Radio::make('gender')->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan'
                ]),
                TextInput::make('nik')
                    ->required()
                    ->maxLength(255),
                TextArea::make('address')->rows(3),
                FileUpload::make('ktp')->directory('agen/ktp'),
                FileUpload::make('mou')->directory('agen/mou'),
                Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mitra.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('number')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('gender')
                    ->searchable(),
                TextColumn::make('nik')
                    ->searchable(),
                TextColumn::make('address')
                    ->searchable(),
                IconColumn::make('status')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            'index' => Pages\ListAgens::route('/'),
            'create' => Pages\CreateAgen::route('/create'),
            'edit' => Pages\EditAgen::route('/{record}/edit'),
        ];
    }
}
