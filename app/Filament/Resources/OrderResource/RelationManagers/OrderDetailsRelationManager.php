<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderDetails';

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
                    ->numeric(),
                Forms\Components\Toggle::make('is_express_delivery')
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(false)
                    ->inline(false)
                    ->afterStateUpdated(function (callable $set, $state) {
                        if (!$state) {
                            $set('is_express_delivery', null);
                        }
                    }),
                Forms\Components\Toggle::make('is_gifted')
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(false)
                    ->inline(false)
                    ->afterStateUpdated(function (callable $set, $state) {
                        if (!$state) {
                            $set('is_gifted', null);
                        }
                    }),
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
                    ->label('Quantity')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
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
