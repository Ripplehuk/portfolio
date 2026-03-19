<?php

namespace App\Filament\Resources\Publications\Schemas;

use App\Models\Publication;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PublicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Publication Meta')
                    ->columns(2)
                    ->schema([
                        Select::make('type')
                            ->options(Publication::typeOptions())
                            ->required()
                            ->default(Publication::TYPE_ARTICLE)
                            ->native(false),
                        TextInput::make('publication_year')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue((int) date('Y') + 10),
                        TextInput::make('doi')->maxLength(255),
                        TextInput::make('link')->url()->maxLength(255),
                    ]),
                Section::make('English Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('authors_en')
                            ->label('Authors (EN)')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('journal_en')
                            ->label('Journal (EN)')
                            ->maxLength(255),
                        Textarea::make('keywords_en')
                            ->label('Keywords (EN)')
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('abstract_en')
                            ->label('Abstract (EN)')
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
                        TextInput::make('authors_uz')
                            ->label('Authors (UZ)')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('journal_uz')
                            ->label('Journal (UZ)')
                            ->maxLength(255),
                        Textarea::make('keywords_uz')
                            ->label('Keywords (UZ)')
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('abstract_uz')
                            ->label('Abstract (UZ)')
                            ->columnSpanFull(),
                    ]),
                Section::make('Media and Sorting')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('pdf_file')
                            ->disk('public')
                            ->directory('publications/pdfs')
                            ->acceptedFileTypes(['application/pdf']),
                        FileUpload::make('cover_image')
                            ->image()
                            ->disk('public')
                            ->directory('publications/covers'),
                        Toggle::make('is_featured'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
