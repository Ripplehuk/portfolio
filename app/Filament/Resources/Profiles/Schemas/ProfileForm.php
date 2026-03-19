<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('full_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('telegram')->maxLength(255),
                    ]),
                Section::make('English Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('position_en')
                            ->label('Position (EN)')
                            ->maxLength(255),
                        TextInput::make('organization_en')
                            ->label('Organization (EN)')
                            ->maxLength(255),
                        TextInput::make('address_en')
                            ->label('Address (EN)')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('short_bio_en')
                            ->label('Short Bio (EN)')
                            ->rows(4)
                            ->columnSpanFull(),
                        RichEditor::make('full_bio_en')
                            ->label('Full Bio (EN)')
                            ->columnSpanFull(),
                    ]),
                Section::make('Uzbek Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('position_uz')
                            ->label('Position (UZ)')
                            ->maxLength(255),
                        TextInput::make('organization_uz')
                            ->label('Organization (UZ)')
                            ->maxLength(255),
                        TextInput::make('address_uz')
                            ->label('Address (UZ)')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('short_bio_uz')
                            ->label('Short Bio (UZ)')
                            ->rows(4)
                            ->columnSpanFull(),
                        RichEditor::make('full_bio_uz')
                            ->label('Full Bio (UZ)')
                            ->columnSpanFull(),
                    ]),
                Section::make('Links and Files')
                    ->columns(2)
                    ->schema([
                        TextInput::make('google_scholar')->url()->maxLength(255),
                        TextInput::make('orcid')->maxLength(255),
                        TextInput::make('scopus')->maxLength(255),
                        TextInput::make('researchgate')->url()->maxLength(255),
                        FileUpload::make('photo')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('profiles/photos'),
                        FileUpload::make('cv_file')
                            ->disk('public')
                            ->directory('profiles/cv')
                            ->acceptedFileTypes(['application/pdf']),
                    ]),
            ]);
    }
}
