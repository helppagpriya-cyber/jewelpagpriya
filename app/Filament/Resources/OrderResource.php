<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Details')
                    ->schema([
                            Forms\Components\Select::make('user_id')
                                ->required()
                                ->label('User')
                                ->placeholder('Select User')
                                ->relationship('user','name')
                                ->searchable()
                                ->preload()
                                ->reactive()
                                ->native(false)
                                ->options(function (callable $get) {
                                    return User::all()->mapWithKeys(function ($user) {
                                        return [
                                            $user->id => $user->name . ' : ' . $user->email
                                        ];
                                    });
                                })
                                ->disabledOn('edit'),

                            Forms\Components\Select::make('user_address_id')
                                ->label('User Address')
                                ->placeholder('Select Address')
                                ->relationship('userAddress','address')
                                ->options(function (callable $get) {
                                    $user_id = $get('user_id');
                                    if ($user_id) {
                                        $user = User::find($user_id);
                                        return $user->userAddresses()->get()->mapWithKeys(function ($userAddress) {
                                            return [
                                                $userAddress->id => strip_tags($userAddress->address) . ' - ' . $userAddress->city . ' - ' . $userAddress->pin
                                            ];
                                        });
                                    }
                                    return [];
                                })
                                ->searchable()
                                ->preload()
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $set('user_address_id', $state);
                                }),
                    ])
                    ->columns(2),
                Section::make('Order Status')
                    ->schema([
                        Forms\Components\ToggleButtons::make('status')
                            ->required()
                            ->default('pending')
                            ->inline(true)
                            ->options([
                                'pending' => 'Pending',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled'
                            ])
                            ->colors([
                                'pending' => 'info',
                                'shipped' => 'warning',
                                'delivered' => 'success',
                                'cancelled' => 'danger'
                            ])
                            ->icons([
                                'pending' => 'heroicon-o-clock',
                                'shipped' => 'heroicon-o-truck',
                                'delivered' => 'heroicon-o-check-badge',
                                'cancelled' => 'heroicon-o-x-circle',
                            ])
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'shipped') {
                                    $set('shipped_date', Carbon::now());
                                } elseif ($state === 'delivered') {
                                    $set('delivered_date', Carbon::now()->toDateString());
                                }
                            }),
                    ]),
                Section::make('Payment Details')
                    ->schema([
                        Forms\Components\Select::make('payment_mode')
                            ->required()
                            ->native(false)
                            ->default('COD')
                            ->options([
                                'COD' => 'COD'
                            ]),
                        Forms\Components\Select::make('payment_status')
                            ->required()
                            ->native(false)
                            ->default('pending')
                            ->options([
                                'pending' => 'Pending',
                                'done' => 'Done'
                            ]),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Sr no.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_items')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->alignCenter()
                    ->getStateUsing(function (Order $record) {
                        return $record->orderDetails()->count();
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'shipped' => 'heroicon-o-truck',
                        'delivered' => 'heroicon-o-check-badge',
                        'cancelled' => 'heroicon-o-x-circle',
                    ]),
            ])
            ->filters([
                //
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
            RelationManagers\OrderDetailsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
