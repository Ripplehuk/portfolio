<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('event_date', 'desc')
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('event_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('location_en')
                    ->label('Location (EN)')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('organizer_en')
                    ->label('Organizer (EN)')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'upcoming' ? 'warning' : 'success')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Order'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'completed' => 'Completed',
                    ]),
            ])
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
