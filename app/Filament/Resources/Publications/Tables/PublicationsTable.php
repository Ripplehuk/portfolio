<?php

namespace App\Filament\Resources\Publications\Tables;

use App\Models\Publication;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PublicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                ImageColumn::make('cover_image')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('type')
                    ->formatStateUsing(fn (string $state): string => Publication::typeOptions()[$state] ?? __('frontend.publication_types.other'))
                    ->badge()
                    ->sortable(),
                TextColumn::make('authors_en')
                    ->label('Authors (EN)')
                    ->searchable()
                    ->limit(40)
                    ->toggleable(),
                TextColumn::make('journal_en')
                    ->label('Journal (EN)')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('publication_year')
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Order'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(Publication::typeOptions()),
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
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
