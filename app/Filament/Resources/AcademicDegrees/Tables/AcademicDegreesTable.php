<?php

namespace App\Filament\Resources\AcademicDegrees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AcademicDegreesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('field_en')
                    ->label('Field (EN)')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('institution_en')
                    ->label('Institution (EN)')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('year')
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
