<?php

namespace App\Filament\Resources\PatientAssessmentResource\Pages;

use App\Filament\Resources\PatientAssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientAssessment extends EditRecord
{
    protected static string $resource = PatientAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
