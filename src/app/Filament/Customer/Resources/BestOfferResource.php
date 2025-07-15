<?php

namespace App\Filament\Customer\Resources;

use App\Filament\Customer\Resources\BestOfferResource\Pages;
use App\Filament\Customer\Resources\BestOfferResource\RelationManagers;
use App\Models\BestOffer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BestOfferResource extends Resource
{
    protected static ?string $model = BestOffer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
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
