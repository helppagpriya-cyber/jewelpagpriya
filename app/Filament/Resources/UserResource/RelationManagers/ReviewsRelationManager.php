<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

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
                Forms\Components\Radio::make('rating')
                    ->required()
                    ->inline(true)
                    ->options([
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        5 => 5
                    ]),
                Forms\Components\Textarea::make('comment'),
                Forms\Components\FileUpload::make('image')
                    ->openable()
                    ->previewable(true)
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('reviews')
                    ->imageEditor(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
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
                Tables\Columns\TextColumn::make('rating')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-star')
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
