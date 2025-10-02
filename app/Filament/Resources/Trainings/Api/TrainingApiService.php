<?php
namespace App\Filament\Resources\Trainings\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\Trainings\TrainingResource;


class TrainingApiService extends ApiService
{
    protected static string | null $resource = TrainingResource::class;
    
    protected static bool $requiresAuthentication = true;
    

    public static function handlers() : array
    {
        return [
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
