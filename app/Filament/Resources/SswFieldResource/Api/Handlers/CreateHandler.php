<?php
namespace App\Filament\Resources\SswFieldResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\SswFieldResource;
use App\Filament\Resources\SswFieldResource\Api\Requests\CreateSswFieldRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = SswFieldResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create SswField
     *
     * @param CreateSswFieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateSswFieldRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}