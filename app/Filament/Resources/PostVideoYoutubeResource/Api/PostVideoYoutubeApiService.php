<?php
namespace App\Filament\Resources\PostVideoYoutubeResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PostVideoYoutubeResource;
use Illuminate\Routing\Router;


class PostVideoYoutubeApiService extends ApiService
{
    protected static string | null $resource = PostVideoYoutubeResource::class;

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
