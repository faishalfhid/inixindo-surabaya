<?php

namespace App\Filament\Resources\Trainings\Pages;

use App\Filament\Resources\Trainings\TrainingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTraining extends CreateRecord
{
    protected static string $resource = TrainingResource::class;
            protected function getRedirectUrl(): string
    {
        // setelah create sukses → kembali ke list
        return $this->getResource()::getUrl('index');
    }
}
