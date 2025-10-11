<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserAddressesRelationManager extends RelationManager
{
    protected static string $relationship = 'userAddresses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->placeholder(123456789)
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->length(10),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->placeholder('Rajkot')
                    ->minLength(2),
                Forms\Components\TextInput::make('pin')
                    ->required()
                    ->placeholder(360002)
                    ->label('Pincode')
                    ->length(6),
                Forms\Components\TextInput::make('state')
                    ->required()
                    ->placeholder('Gujarat')
                    ->minLength(3),
                Forms\Components\RichEditor::make('address')
                    ->required()
                    ->placeholder('House no. 123, "XYZ" street')
                    ->columnSpan(2)
                    ->disableToolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'strike',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('address')
            ->columns([
                Tables\Columns\TextColumn::make('Sr no.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('address')
                    ->formatStateUsing(fn ($state) => strip_tags($state)),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('city')
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
