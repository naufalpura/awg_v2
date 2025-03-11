<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActSubCategoryResource\Pages;
use App\Filament\Resources\ActSubCategoryResource\RelationManagers;
use App\Models\ActCategory;
use App\Models\ActSubCategory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActSubCategoryResource extends Resource
{
    protected static ?string $model = ActSubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Sub Kategori';
    protected static ?string $modelLabel = 'Sub Kategori';
    // protected static ?string $navigationGroup = 'Content';
    protected static ?string $slug = 'sub-kategori';
    protected static ?string $pluralLabel = 'Sub Kategori';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('act_category_id')->options(ActCategory::all()->pluck('name', 'id'))->default(1)->label('Kategori'),
                TextInput::make('name')->label('Nama Sub Kategori'),
                Toggle::make('status')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('category.name'),
                ToggleColumn::make('status'),
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
            'index' => Pages\ManageActSubCategories::route('/'),
        ];
    }
}
