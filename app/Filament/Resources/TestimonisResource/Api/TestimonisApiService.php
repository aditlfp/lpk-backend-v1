<?php
namespace App\Filament\Resources\TestimonisResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\TestimonisResource;
use Illuminate\Routing\Router;


class TestimonisApiService extends ApiService
{
    protected static string | null $resource = TestimonisResource::class;

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
