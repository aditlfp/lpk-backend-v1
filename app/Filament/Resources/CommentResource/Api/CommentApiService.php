<?php
namespace App\Filament\Resources\CommentResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\CommentResource;
use Illuminate\Routing\Router;


class CommentApiService extends ApiService
{
    protected static string | null $resource = CommentResource::class;

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
