<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Parent Category')
                            ->placeholder('Select parent category')
                            ->preload()
                            ->searchable()
                            ->relationship('category', 'name', function($query) {
                                $query->whereNull('category_id');
                            })
                            ->native(false),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->placeholder('Ring')
                            ->unique(ignoreRecord: true)
                            ->label('Category')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->minLength(2)
                            ->validationMessages([
                                'unique' => 'The :attribute has already been added.'
                            ]),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->readOnly(),
                        Forms\Components\FileUpload::make('image')
                            ->required()
                            ->openable()
                            ->previewable(true)
                            ->image()
                            ->disk('public')
                            ->directory('users')
                            ->imageEditor(),
                        Forms\Components\Toggle::make('status')
                            ->label('Status')
                            ->onIcon('heroicon-m-eye')
                            ->offIcon('heroicon-m-eye-slash')
                            ->default(true)
                            ->afterStateUpdated(fn ($state, $set) => $set('status', $state))
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Sr no.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Category Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Parent Category')
                    ->default('------')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('category_id')
                    ->label('Is Parent Category')
                    ->boolean()
                    ->alignCenter()
                    ->getStateUsing(fn ($record) => is_null($record->category_id)),
                Tables\Columns\ToggleColumn::make('status')
                    ->onIcon('heroicon-m-eye')
                    ->offIcon('heroicon-m-eye-slash')
//                    ->afterStateUpdated(function ($state, $record) {
//                        // Check if the category is a parent category and the status was set to 0
//                        if (is_null($record->category_id) && $state === 0) {
//                            // Update the status of all child categories
//                            $record->updateChildCategoriesStatus();
//                        }
//                    })
                    ->afterStateUpdated(function ($state, $record) {
                        // Check if the category is a parent category
                        if (is_null($record->category_id)) {
                            // Update the status of all child categories
                            $record->updateChildCategoriesStatus();
                        }
                    })
//                    ->afterStateUpdated(function ($state, $record) {
//                        // If the category is a parent, update child categories' status
//                        if (is_null($record->category_id)) {
//                            $record->updateChildCategoriesStatus();
//                        }
//                    })
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive'
                    ])
                    ->native(false),
                Tables\Filters\SelectFilter::make('category_id')
                    ->options([
                          'NULL' => 'Parent Categories',
                    ])
                    ->label('Category')
                    ->native(false)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
