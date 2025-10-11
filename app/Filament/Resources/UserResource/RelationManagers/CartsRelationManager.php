<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CartsRelationManager extends RelationManager
{
    protected static string $relationship = 'carts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'name')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        $imageUrl = $record->images[0];
                        return '<div class="flex items-center space-x-2">
                                    <img src="/storage/' . $imageUrl . '" alt="' . $record->name . '" class="w-10 h-8 rounded"/>
                                    <span class="mx-3">' . $record->name . '</span>
                                </div>';
                    })
                    ->allowHtml()
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('product_size_id')
                    ->label('Size')
                    ->options(function ($get) {
                        $productId = $get('product_id');
                        return \App\Models\ProductSize::where('product_id', $productId)
                            ->pluck('size', 'id')
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_id')
            ->columns([
                Tables\Columns\TextColumn::make('Sr no.')
                    ->rowIndex(),
                Tables\Columns\ImageColumn::make('product.images')
                    ->limit(1)
                    ->label('Product Image'),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->searchable()
                    ->sortable()
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }
}
