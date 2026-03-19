<?php

namespace App\Filament\Resources\GalleryItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleryItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('category_en')
                    ->label('Category (EN)')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Order'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
