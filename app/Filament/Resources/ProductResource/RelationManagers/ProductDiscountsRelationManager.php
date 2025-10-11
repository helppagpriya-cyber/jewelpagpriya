<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductDiscountsRelationManager extends RelationManager
{
    protected static string $relationship = 'productDiscounts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('discount')
                    ->required()
                    ->label('Discount (Rs.)'),
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->native(false)
                    ->unique(ignoreRecord: true)
                    ->default(fn() => Carbon::now()->format('Y-m-d')),
                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->native(false)
                    ->unique(ignoreRecord: true)
                    ->default(fn() => Carbon::now()->format('Y-m-d'))
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('discount')
            ->columns([
                Tables\Columns\TextColumn::make('Sr no.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('discount')
                    ->sortable()
                    ->icon(fn ($record) => 'heroicon-o-currency-rupee'),
                Tables\Columns\TextColumn::make('start_date')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('M d, Y')),
                Tables\Columns\TextColumn::make('end_date')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('M d, Y')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }
}
