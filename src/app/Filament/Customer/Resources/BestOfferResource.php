<?php

namespace App\Filament\Customer\Resources;

use App\Models\BestOffer;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class BestOfferResource extends Resource
{
    protected static ?string $model = BestOffer::class;
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static ?string $navigationLabel = 'Penawaran Terbaik';
    protected static ?string $slug = 'penawaran-terbaik';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('shoe.image_url')
                    ->label('Gambar Sepatu')
                    ->circular()
                    ->size(50),

                TextColumn::make('shoe.name')
                    ->label('Nama Sepatu')
                    ->searchable(),

                TextColumn::make('discount_percentage')
                    ->label('Diskon')
                    ->suffix('%'),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date(),

                TextColumn::make('end_date')
                    ->label('Berakhir')
                    ->date(),
            ])
            ->actions([]) // Tidak ada tombol Edit, Delete, dsb
            ->bulkActions([]); // Tidak ada aksi bulk
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Customer\Resources\BestOfferResource\Pages\ListBestOffers::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
