<?php

namespace App\Filament\Admin\Resources\ShoeResource\Pages;

use App\Filament\Admin\Resources\ShoeResource;
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
