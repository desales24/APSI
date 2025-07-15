<?php

namespace App\Filament\Customer\Resources;

use App\Models\Shoe;
use App\Models\CategoryShoe;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use App\Filament\Customer\Resources\ShoeResource\Pages;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ShoeResource extends Resource
{
    protected static ?string $model = Shoe::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Katalog Sepatu';
    protected static ?string $slug = 'katalog-sepatu';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Gambar')
                    ->size(50)
                    ->circular()
                    ->disk('public'),

                TextColumn::make('name')
                    ->label('Nama Sepatu')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Kategori'),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR'),

                TextColumn::make('stock')
                    ->label('Stok'),
            ])
            ->actions([]) // Tidak ada edit
            ->bulkActions([]); // Tidak ada bulk delete
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShoes::route('/'),
        ];
    }
}
