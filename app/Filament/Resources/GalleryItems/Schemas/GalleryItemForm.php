<?php

namespace App\Filament\Resources\GalleryItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Media')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('gallery'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('English Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->maxLength(255),
                        TextInput::make('category_en')
                            ->label('Category (EN)')
                            ->maxLength(255),
                        Textarea::make('description_en')
                            ->label('Description (EN)')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
                Section::make('Uzbek Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title_uz')
                            ->label('Title (UZ)')
                            ->maxLength(255),
                        TextInput::make('category_uz')
                            ->label('Category (UZ)')
                            ->maxLength(255),
                        Textarea::make('description_uz')
                            ->label('Description (UZ)')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
