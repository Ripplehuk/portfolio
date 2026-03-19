<?php

namespace App\Filament\Resources\AcademicDegrees\Pages;

use App\Filament\Resources\AcademicDegrees\AcademicDegreeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademicDegrees extends ListRecords
{
    protected static string $resource = AcademicDegreeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
