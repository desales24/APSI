<?php

namespace App\Filament\Admin\Resources;

use App\Models\Shoe;
use App\Models\CategoryShoe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Admin\Resources\ShoeResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ShoeResource extends Resource
{
    protected static ?string $model = Shoe::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required(),

            Select::make('category_id')
                ->label('Category')
                ->options(CategoryShoe::pluck('name', 'id'))
                ->required(),

            TextInput::make('price')->numeric()->required(),

            TextInput::make('stock')->numeric()->default(0),

            FileUpload::make('image_url')
                ->label('Gambar Sepatu')
                ->image()
                ->imagePreviewHeight('150')
                ->directory('shoes')
                ->disk('public')
                ->nullable()
                ->downloadable(),

            TextInput::make('description')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                ImageColumn::make('image_url')
                    ->label('Gambar')
                    ->size(50)
                    ->circular(),

                TextColumn::make('name')->searchable(),

                TextColumn::make('category.name')->label('Category'),

                TextColumn::make('price')->money('IDR'),

                TextColumn::make('stock'),
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
            'index' => Pages\ListShoes::route('/'),
            'create' => Pages\CreateShoe::route('/create'),
            'edit' => Pages\EditShoe::route('/{record}/edit'),
        ];
    }
}
