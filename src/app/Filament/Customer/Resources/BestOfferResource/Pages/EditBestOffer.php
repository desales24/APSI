<?php

namespace App\Filament\Customer\Resources\BestOfferResource\Pages;

use App\Filament\Customer\Resources\BestOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBestOffer extends EditRecord
{
    protected static string $resource = BestOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
