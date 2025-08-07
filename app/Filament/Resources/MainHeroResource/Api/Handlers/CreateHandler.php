<?php
namespace App\Filament\Resources\MainHeroResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\MainHeroResource;
use App\Filament\Resources\MainHeroResource\Api\Requests\CreateMainHeroRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = MainHeroResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create MainHero
     *
     * @param CreateMainHeroRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateMainHeroRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}