<?php
namespace App\Filament\Resources\LpkClassResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\LpkClassResource;
use App\Filament\Resources\LpkClassResource\Api\Requests\CreateLpkClassRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = LpkClassResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create LpkClass
     *
     * @param CreateLpkClassRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateLpkClassRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}