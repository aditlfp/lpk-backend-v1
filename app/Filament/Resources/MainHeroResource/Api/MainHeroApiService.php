<?php
namespace App\Filament\Resources\MainHeroResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\MainHeroResource;
use Illuminate\Routing\Router;


class MainHeroApiService extends ApiService
{
    protected static string | null $resource = MainHeroResource::class;

    protected static string | null $groupRouteName = 'main_hero';

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
