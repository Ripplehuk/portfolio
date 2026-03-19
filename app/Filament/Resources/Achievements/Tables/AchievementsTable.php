<?php

namespace App\Filament\Resources\Achievements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AchievementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('achievement_date', 'desc')
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('issuer_en')
                    ->label('Issuer (EN)')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('achievement_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Order'),
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
