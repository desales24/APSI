<?php

namespace App\Filament\Admin\Resources;

use App\Models\CategoryShoe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Admin\Resources\CategoryShoeResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class CategoryShoeResource extends Resource
{
    protected static ?string $model = CategoryShoe::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('description')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('description'),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategoryShoes::route('/'),
            'create' => Pages\CreateCategoryShoe::route('/create'),
            'edit' => Pages\EditCategoryShoe::route('/{record}/edit'),
        ];
    }
}
