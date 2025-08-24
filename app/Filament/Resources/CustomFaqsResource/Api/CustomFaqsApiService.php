<?php
namespace App\Filament\Resources\CustomFaqsResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\CustomFaqsResource;
use Illuminate\Routing\Router;


class CustomFaqsApiService extends ApiService
{
    protected static string | null $resource = CustomFaqsResource::class;

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
