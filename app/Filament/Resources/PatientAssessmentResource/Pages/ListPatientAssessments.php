<?php

namespace App\Filament\Resources\PatientAssessmentResource\Pages;

use App\Filament\Resources\PatientAssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientAssessments extends ListRecords
{
    protected static string $resource = PatientAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
