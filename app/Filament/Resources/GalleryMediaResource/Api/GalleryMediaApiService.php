<?php
namespace App\Filament\Resources\GalleryMediaResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\GalleryMediaResource;
use Illuminate\Routing\Router;


class GalleryMediaApiService extends ApiService
{
    protected static string | null $resource = GalleryMediaResource::class;

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
