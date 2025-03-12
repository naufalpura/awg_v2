<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Jamaah;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JamaahResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JamaahResource\RelationManagers;

class JamaahResource extends Resource
{
    protected static ?string $model = Jamaah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Jamaah';
    protected static ?string $modelLabel = 'Jamaah';
    // protected static ?string $navigationGroup = 'Content';
    protected static ?string $slug = 'jamaah';
    protected static ?string $pluralLabel = 'Jamaah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('register_date')
                    ->required(),
                TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('gender')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nik')
                    ->required()
                    ->maxLength(255),
                Select::make('packet_umroh_id')
                    ->relationship('packetUmroh', 'name')
                    ->required(),
                TextInput::make('nominal')
                    ->required()
                    ->numeric(),
                Select::make('mitra_id')
                    ->relationship('mitra', 'name')
                    ->required(),
                Select::make('agen_id')
                    ->relationship('agen', 'name')
                    ->required(),
                Select::make('freelancer_id')
                    ->relationship('freelancer', 'name')
                    ->required(),
                FileUpload::make('form')->directory('jamaah/ktp'),
                FileUpload::make('akad')->directory('jamaah/ktp'),
                FileUpload::make('proof')->directory('jamaah/ktp')->label('Bukti pembayaran'),
                FileUpload::make('ktp')->directory('jamaah/ktp'),
                Toggle::make('status')
                    ->default(1)
                    ->required(),
                Textarea::make('description')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('register_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('packetUmroh.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mitra.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agen.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('freelancer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\IconColumn::make('description')
                    ->boolean(),
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
            'index' => Pages\ListJamaahs::route('/'),
            'create' => Pages\CreateJamaah::route('/create'),
            'edit' => Pages\EditJamaah::route('/{record}/edit'),
        ];
    }
}
