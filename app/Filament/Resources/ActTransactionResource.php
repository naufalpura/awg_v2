<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ActCategory;
use App\Models\ActTransaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ActTransactionResource\Pages;
use App\Filament\Resources\ActTransactionResource\RelationManagers;
use App\Filament\Resources\ActTransactionResource\Widgets\TransactionOverview;

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
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('subCategory.category.name')->label('Kategori')
                    ->sortable(),
                TextColumn::make('subCategory.name')->label('Sub Kategori')
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('bank.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type')
                    ->searchable(),
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
                // Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->placeholder(fn($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('date_until')
                            ->placeholder(fn($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['date_until'] ?? null,
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['date_from'] ?? null) {
                            $indicators['date_from'] = 'Trx from ' . Carbon::parse($data['date_from'])->toFormattedDateString();
                        }
                        if ($data['date_until'] ?? null) {
                            $indicators['date_until'] = 'Trx until ' . Carbon::parse($data['date_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            // 'edit' => Pages\EditActTransaction::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TransactionOverview::class,
        ];
    }
}
