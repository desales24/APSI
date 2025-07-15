<?php

namespace App\Filament\Customer\Resources;

use App\Models\Payment;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Customer\Resources\PaymentResource\Pages;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Auth;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran Saya';
    protected static ?string $slug = 'pembayaran';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('order_id')
                ->label('Pesanan')
                ->options(function () {
                    return Order::where('customer_email', Auth::user()->email)
                        ->pluck('customer_name', 'id');
                })
                ->searchable()
                ->required(),

            Select::make('payment_method')
                ->label('Metode Pembayaran')
                ->options([
                    'BCA' => 'BCA',
                    'QRIS' => 'QRIS',
                    'COD' => 'COD',
                ])
                ->required(),

            DateTimePicker::make('paid_at')
                ->label('Tanggal Pembayaran')
                ->nullable(),

            FileUpload::make('proof_of_payment')
                ->label('Bukti Pembayaran (Gambar)')
                ->image()
                ->imagePreviewHeight('100')
                ->directory('payments')
                ->disk('public')
                ->downloadable()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Payment::query()->whereHas('order', function ($query) {
                    $query->where('customer_email', Auth::user()->email);
                });
            })
            ->columns([
                TextColumn::make('order.customer_name')
                    ->label('Pelanggan')
                    ->searchable(),

                TextColumn::make('payment_method')
                    ->label('Metode'),

                TextColumn::make('status')
                    ->badge()
                    ->label('Status'),

                TextColumn::make('paid_at')
                    ->dateTime()
                    ->label('Tanggal Bayar'),

                ImageColumn::make('proof_of_payment')
                    ->label('Bukti Pembayaran')
                    ->circular()
                    ->size(50)
                    ->disk('public'),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),

                \Filament\Tables\Actions\Action::make('print')
                    ->label('Cetak Struk')
                    ->icon('heroicon-o-printer')
                    ->url(fn ($record) => route('print.payment', $record))
                    ->openUrlInNewTab(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/buat'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
