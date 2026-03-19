<?php

namespace App\Filament\Resources\AcademicDegrees;

use App\Filament\Resources\AcademicDegrees\Pages\CreateAcademicDegree;
use App\Filament\Resources\AcademicDegrees\Pages\EditAcademicDegree;
use App\Filament\Resources\AcademicDegrees\Pages\ListAcademicDegrees;
use App\Filament\Resources\AcademicDegrees\Schemas\AcademicDegreeForm;
use App\Filament\Resources\AcademicDegrees\Tables\AcademicDegreesTable;
use App\Models\AcademicDegree;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AcademicDegreeResource extends Resource
{
    protected static ?string $model = AcademicDegree::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string|\UnitEnum|null $navigationGroup = 'Profile';

    protected static ?string $modelLabel = 'Academic Degree';

    protected static ?string $pluralModelLabel = 'Academic Degrees';

    protected static ?string $recordTitleAttribute = 'title_en';

    public static function form(Schema $schema): Schema
    {
        return AcademicDegreeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicDegreesTable::configure($table);
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
            'index' => ListAcademicDegrees::route('/'),
            'create' => CreateAcademicDegree::route('/create'),
            'edit' => EditAcademicDegree::route('/{record}/edit'),
        ];
    }
}
