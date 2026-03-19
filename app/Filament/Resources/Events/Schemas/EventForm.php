<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event Meta')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('event_date'),
                        Select::make('status')
                            ->options([
                                'upcoming' => 'Upcoming',
                                'completed' => 'Completed',
                            ])
                            ->default('completed')
                            ->required(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('events/images')
                            ->columnSpanFull(),
                    ]),
                Section::make('English Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('location_en')
                            ->label('Location (EN)')
                            ->maxLength(255),
                        TextInput::make('organizer_en')
                            ->label('Organizer (EN)')
                            ->maxLength(255),
                        RichEditor::make('description_en')
                            ->label('Description (EN)')
                            ->columnSpanFull(),
                    ]),
                Section::make('Uzbek Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title_uz')
                            ->label('Title (UZ)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('location_uz')
                            ->label('Location (UZ)')
                            ->maxLength(255),
                        TextInput::make('organizer_uz')
                            ->label('Organizer (UZ)')
                            ->maxLength(255),
                        RichEditor::make('description_uz')
                            ->label('Description (UZ)')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
