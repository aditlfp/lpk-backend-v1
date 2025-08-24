<?php
namespace App\Filament\Resources\LpkClassResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\LpkClassResource;
use Illuminate\Routing\Router;


class LpkClassApiService extends ApiService
{
    protected static string | null $resource = LpkClassResource::class;

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
