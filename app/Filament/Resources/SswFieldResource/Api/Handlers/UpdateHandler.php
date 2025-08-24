<?php
namespace App\Filament\Resources\SswFieldResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\SswFieldResource;
use App\Filament\Resources\SswFieldResource\Api\Requests\UpdateSswFieldRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = SswFieldResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update SswField
     *
     * @param UpdateSswFieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateSswFieldRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}