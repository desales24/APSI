<?php

namespace App\Filament\Admin\Resources;

use App\Models\BestOffer;
use App\Models\Shoe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Admin\Resources\BestOfferResource\Pages;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class BestOfferResource extends Resource
{
    protected static ?string $model = BestOffer::class;
    protected static ?string $navigationIcon = 'heroicon-o-fire';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('shoe_id')
                ->label('Shoe')
                ->relationship('shoe', 'name')
                ->required(),
            TextInput::make('discount_percentage')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->required(),
            DatePicker::make('start_date')->required(),
            DatePicker::make('end_date')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('shoe.image_url')
                ->label('Gambar Sepatu')
                ->circular()
                ->size(50),

            TextColumn::make('shoe.name')->label('Shoe'),
            TextColumn::make('discount_percentage')->label('Diskon')->suffix('%'),
            TextColumn::make('start_date')->date(),
            TextColumn::make('end_date')->date(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBestOffers::route('/'),
            'create' => Pages\CreateBestOffer::route('/create'),
            'edit' => Pages\EditBestOffer::route('/{record}/edit'),
        ];
    }
}
