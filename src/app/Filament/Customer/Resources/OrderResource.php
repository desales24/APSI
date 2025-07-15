<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Shoe;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Pesanan Saya';
    protected static ?string $slug = 'pesanan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Placeholder::make('info')->content('Data customer diambil dari akun Anda.'),

            TextInput::make('customer_name')
                ->default(Auth::user()->name)
                ->required()
                ->readOnly(),

            TextInput::make('customer_email')
                ->default(Auth::user()->email)
                ->required()
                ->readOnly(),

            TextInput::make('customer_phone')->required(),
            TextInput::make('customer_address')->required(),

            Repeater::make('items')
                ->relationship('items')
                ->label('Item Pesanan')
                ->schema([
                    Select::make('shoe_id')
                        ->label('Sepatu')
                        ->options(Shoe::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $shoe = Shoe::with('bestOffer')->find($state);
                            if ($shoe) {
                                $set('price', $shoe->price);
                                $set('discount', $shoe->bestOffer?->discount_percentage ?? 0);
                            }
                        }),

                    TextInput::make('quantity')
                        ->numeric()
                        ->default(1)
                        ->required()
                        ->reactive(),

                    TextInput::make('price')
                        ->numeric()
                        ->label('Harga Satuan')
                        ->required()
                        ->readOnly(),

                    TextInput::make('discount')
                        ->numeric()
                        ->label('Diskon (%)')
                        ->readOnly(),

                    Placeholder::make('subtotal')
                        ->label('Subtotal')
                        ->content(function (callable $get) {
                            $qty = (int) $get('quantity');
                            $price = (float) $get('price');
                            $discount = (float) $get('discount');
                            $subtotal = $qty * $price * (1 - $discount / 100);
                            return 'Rp ' . number_format($subtotal, 0, ',', '.');
                        })
                        ->reactive(),
                ])
                ->createItemButtonLabel('Tambah Sepatu')
                ->reactive()
                ->columnSpanFull(),

            Placeholder::make('total_placeholder')
                ->label('Total Harga')
                ->content(function (callable $get) {
                    $items = $get('items');
                    if (!is_array($items)) return 'Rp 0';

                    $total = collect($items)->sum(function ($item) {
                        $qty = (int) ($item['quantity'] ?? 0);
                        $price = (float) ($item['price'] ?? 0);
                        $discount = (float) ($item['discount'] ?? 0);
                        return $qty * $price * (1 - $discount / 100);
                    });

                    return 'Rp ' . number_format($total, 0, ',', '.');
                })
                ->reactive()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Order::query()->where('customer_email', Auth::user()->email);
            })
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('status')->badge(),
                TextColumn::make('total')->money('IDR'),
                TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/buat'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
