<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make('Material Details')
                        ->schema([
                            Forms\Components\Select::make('metal_id')
                                ->label('Metal')
                                ->placeholder('Select Metal')
                                ->relationship('metal','name')
                                ->searchable()
                                ->preload()
                                ->native(false),
                            Forms\Components\Select::make('category_id')
                                ->label('Category')
                                ->placeholder('Select category')
                                ->relationship('category', 'name', function($query) {
                                    $query->whereNotNull('category_id');
                                })
                                ->searchable()
                                ->preload()
                                ->native(false),
                            Forms\Components\Select::make('gemstone_id')
                                ->label('Gemstone')
                                ->placeholder('Select Gemstone')
                                ->relationship('gemstone','name')
                                ->searchable()
                                ->preload()
                                ->native(false),
                            Forms\Components\Select::make('occasion_id')
                                ->label('Occasion')
                                ->placeholder('Select Occasion')
                                ->relationship('occasion','name')
                                ->searchable()
                                ->preload()
                                ->native(false),
                        ])
                        ->columns(2),
                    Section::make([
                        Forms\Components\Toggle::make('status')
                            ->label('Status')
                            ->onIcon('heroicon-m-eye')
                            ->offIcon('heroicon-m-eye-slash')
                            ->default(true)
                            ->inline(false)
                            ->afterStateUpdated(fn ($state, $set) => $set('status', $state)),
                        Forms\Components\Radio::make('gender')
                            ->label('Gender')
                            ->options([
                                'M' => 'Male',
                                'F' => 'Female',
                            ]),
                    ])
                        ->grow(false)
                        ->columns(1),
                ])->from('md'), // end split
                Section::make('Product Details')
                    ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->minLength(2)
                                ->placeholder('Diamond Ring')
                                ->validationMessages([
                                    'unique' => 'The :attribute has already been added.'
                                ]),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->readOnly(),
                            Forms\Components\RichEditor::make('description')
                                ->required()
                                ->columnSpan(2)
                                ->disableToolbarButtons([
                                    'attachFiles',
                                    'blockquote',
                                    'codeBlock',
                                    'h2',
                                    'h3',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'strike',
                                ]),
                        ])
                    ->columns(2),
                    Section::make('Images')
                        ->schema([
                            Forms\Components\FileUpload::make('images')
                                ->required()
                                ->openable()
                                ->previewable(true)
                                ->image()
                                ->disk('public')
                                ->directory('products')
                                ->multiple()
                                ->imageEditor()
                                ->reorderable(),
                        ]),
                    Section::make('Warranty & Delivery Details')
                        ->schema([
                            Forms\Components\TextInput::make('warranty_period')
                                ->placeholder('2 Month'),
                            Forms\Components\TextInput::make('delivery_charge')
                                ->placeholder(100)
                                ->numeric(),
                            Forms\Components\Toggle::make('express_delivery_available')
                                ->onIcon('heroicon-m-check-circle')
                                ->offIcon('heroicon-m-x-circle')
                                ->onColor('success')
                                ->offColor('danger')
                                ->default(false)
                                ->inline(false)
                                ->afterStateUpdated(function (callable $set, $state) {
                                    if (!$state) {
                                        $set('express_delivery_charge', null);
                                    }
                                }),
                            Forms\Components\TextInput::make('express_delivery_charge')
                                ->numeric()
                                ->placeholder(200)
                                ->required(fn ($get) => $get('express_delivery_available') === true)
                        ])
                        ->columns(2)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Sr no.')
                    ->rowIndex(),
                Tables\Columns\ImageColumn::make('images')
                    ->square()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Available sizes')
                    ->label('Available Sizes')
                    ->getStateUsing(function (Product $record) {
                        return $record->productSizes()->count();
                    })
                    ->icon(fn ($record) => 'heroicon-o-tag')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('has_active_offer')
                    ->label('Active Offer')
                    ->badge()
                    ->alignCenter()
                    ->getStateUsing(function (Product $record) {
                        $activeOffer = $record->productDiscounts()
                            ->whereDate('start_date', '<=', Carbon::now())
                            ->whereDate('end_date', '>=', Carbon::now())
                            ->exists();

                        return $activeOffer ? 'Yes' : 'No';
                    })
                    ->colors([
                        'info' => 'Yes',  // Green color for active offer
                        'warning' => 'No',    // Red color for inactive offer
                    ]),
                Tables\Columns\IconColumn::make('express_delivery_available')
                    ->label('Express Delivery')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\ToggleColumn::make('status')
                    ->onIcon('heroicon-m-eye')
                    ->offIcon('heroicon-m-eye-slash')
                    ->extraAttributes(['class'=>'w-8'])

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive'
                    ])
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductSizesRelationManager::class,
            RelationManagers\ProductDiscountsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
