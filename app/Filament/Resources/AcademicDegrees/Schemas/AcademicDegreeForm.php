<?php

namespace App\Filament\Resources\AcademicDegrees\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AcademicDegreeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Academic Degree Meta')
                    ->columns(2)
                    ->schema([
                        TextInput::make('year')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue((int) date('Y') + 10),
                        TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make('English Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title_en')
                            ->label('Title (EN)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('field_en')
                            ->label('Field (EN)')
                            ->maxLength(255),
                        TextInput::make('institution_en')
                            ->label('Institution (EN)')
                            ->maxLength(255),
                        TextInput::make('country_en')
                            ->label('Country (EN)')
                            ->maxLength(255),
                        Textarea::make('description_en')
                            ->label('Description (EN)')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
                Section::make('Uzbek Content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title_uz')
                            ->label('Title (UZ)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('field_uz')
                            ->label('Field (UZ)')
                            ->maxLength(255),
                        TextInput::make('institution_uz')
                            ->label('Institution (UZ)')
                            ->maxLength(255),
                        TextInput::make('country_uz')
                            ->label('Country (UZ)')
                            ->maxLength(255),
                        Textarea::make('description_uz')
                            ->label('Description (UZ)')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
