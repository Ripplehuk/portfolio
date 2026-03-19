<?php

namespace App\Filament\Resources\AcademicDegrees\Pages;

use App\Filament\Resources\AcademicDegrees\AcademicDegreeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademicDegree extends EditRecord
{
    protected static string $resource = AcademicDegreeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
