<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Textarea::make('text')
                            ->required()
                            ->autosize()
                            ->placeholder('Get 10% Off Now !')
                            ->unique(ignoreRecord: true)
                            ->minLength(5)
                            ->validationMessages([
                                'unique' => 'The :attribute has already been added.'
                            ]),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->placeholder('Get the offer now... ! Be the first to win the gift ....'),
                        Forms\Components\FileUpload::make('image')
                            ->required()
                            ->openable()
                            ->previewable(true)
                            ->image()
                            ->disk('public')
                            ->directory('sliders')
                            ->imageEditor(),
                        Forms\Components\ColorPicker::make('bg_color')
                            ->required()
                            ->label('Background Color')
                            ->default('#5C3422'),
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
                Tables\Columns\TextColumn::make('text')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->alignCenter()
                    ->width(65),
                Tables\Columns\ColorColumn::make('bg_color')
                    ->alignCenter(),
                Tables\Columns\ToggleColumn::make('status')
                    ->onIcon('heroicon-m-eye')
                    ->offIcon('heroicon-m-eye-slash')
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive'
                    ])
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
