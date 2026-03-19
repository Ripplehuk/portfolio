<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Achievement Meta')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('achievement_date'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('achievements/images'),
                        FileUpload::make('certificate_file')
                            ->disk('public')
                            ->directory('achievements/certificates')
                            ->acceptedFileTypes(['application/pdf']),
                    ]),
                Section::make('English Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('issuer_en')
                            ->label('Issuer (EN)')
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
                        TextInput::make('issuer_uz')
                            ->label('Issuer (UZ)')
                            ->maxLength(255),
                        RichEditor::make('description_uz')
                            ->label('Description (UZ)')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
