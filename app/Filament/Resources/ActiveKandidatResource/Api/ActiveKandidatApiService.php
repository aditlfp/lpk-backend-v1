<?php
namespace App\Filament\Resources\ActiveKandidatResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ActiveKandidatResource;
use Illuminate\Routing\Router;


class ActiveKandidatApiService extends ApiService
{
    protected static string | null $resource = ActiveKandidatResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
