<?php

namespace App\Filament\Admin\Resources\CategoryShoeResource\Pages;

use App\Filament\Admin\Resources\CategoryShoeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryShoes extends ListRecords
{
    protected static string $resource = CategoryShoeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
