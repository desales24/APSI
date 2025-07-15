<?php

namespace App\Filament\Customer\Resources\ShoeResource\Pages;

use App\Filament\Customer\Resources\ShoeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShoe extends EditRecord
{
    protected static string $resource = ShoeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
