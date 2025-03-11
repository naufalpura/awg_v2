<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Freelancer;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FreelancerResource\Pages;
use App\Filament\Resources\FreelancerResource\RelationManagers;

class FreelancerResource extends Resource
{
    protected static ?string $model = Freelancer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Freelance';
    protected static ?string $modelLabel = 'Freelance';
    // protected static ?string $navigationGroup = 'Content';
    protected static ?string $slug = 'freelance';
    protected static ?string $pluralLabel = 'Freelance';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('agen_id')
                    ->relationship('agen', 'name')
                    ->required(),
                TextInput::make('number')
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
                TextArea::make('address')->rows(3),
                FileUpload::make('ktp')->directory('freelance/ktp'),
                FileUpload::make('mou')->directory('freelance/mou'),
                Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('agen.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('number')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                Radio::make('gender')->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan'
                ]),
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
            'index' => Pages\ListFreelancers::route('/'),
            'create' => Pages\CreateFreelancer::route('/create'),
            'edit' => Pages\EditFreelancer::route('/{record}/edit'),
        ];
    }
}
