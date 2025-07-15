<?php

namespace App\Filament\Customer\Resources\BestOfferResource\Pages;

use App\Filament\Customer\Resources\BestOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBestOffers extends ListRecords
{
    protected static string $resource = BestOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
