<?php

namespace App\Filament\Resources\ContactMessages;

use App\Filament\Resources\ContactMessages\Pages\ListContactMessages;
use App\Filament\Resources\ContactMessages\Pages\ViewContactMessage;
use App\Filament\Resources\ContactMessages\Schemas\ContactMessageForm;
use App\Filament\Resources\ContactMessages\Tables\ContactMessagesTable;
use App\Models\ContactMessage;
use BackedEnum;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Communication';

    protected static ?string $modelLabel = 'Contact Message';

    protected static ?string $pluralModelLabel = 'Contact Messages';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ContactMessageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')->copyable(),
                TextEntry::make('subject')->placeholder('-'),
                IconEntry::make('is_read')->boolean()->label('Read'),
                TextEntry::make('created_at')->dateTime()->label('Received at'),
                TextEntry::make('updated_at')->dateTime(),
                TextEntry::make('message')
                    ->columnSpanFull()
                    ->prose(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return ContactMessagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactMessages::route('/'),
            'view' => ViewContactMessage::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}

