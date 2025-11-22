<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductSizesRelationManager extends RelationManager
{
    protected static string $relationship = 'productSizes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('size')
                    ->required(),
//                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric(),
                Section::make('Metal Details')
                    ->schema([
                        Forms\Components\TextInput::make('metal_weight')
                            ->required()
                            ->placeholder('2 GM'),
                        Forms\Components\TextInput::make('metal_purity')
                            ->required()
                            ->placeholder('22 K'),
                        Forms\Components\TextInput::make('metal_price')
                            ->required()
                            ->placeholder(18000)
                    ])
                    ->columns(3),
                Section::make('Gemstone Details')
                    ->schema([
                        Forms\Components\TextInput::make('gemstone_weight')
                            ->placeholder('0.5 GM')
                            ->label('Gemstone Weight (Per PC)'),
                        Forms\Components\TextInput::make('gemstone_purity')
                            ->placeholder('24 K'),
                        Forms\Components\TextInput::make('num_of_gemstone')
                            ->placeholder(2),
                        Forms\Components\TextInput::make('gemstone_price')
                            ->placeholder(20000)
                    ])
                    ->columns(2),
                Section::make('Other Charges Details')
                    ->schema([
                        Forms\Components\TextInput::make('making_charges')
                            ->required()
                            ->placeholder(10000),
                        Forms\Components\TextInput::make('gst')
                            ->required()
                            ->placeholder(4000),
                    ])
                    ->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('size')
            ->columns([
                Tables\Columns\TextColumn::make('Sr no.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('size')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->sortable(),
                Tables\Columns\TextColumn::make('making_charges')
                    ->sortable(),
                Tables\Columns\TextColumn::make('gst')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Total Price')
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return $record->metal_price + $record->gemstone_price + $record->making_charges + $record->gst;
                    })
                    ->icon(fn ($record) => 'heroicon-o-currency-rupee'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
