<?php
namespace App\Filament\Resources\ActiveKandidatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ActiveKandidatResource;
use App\Filament\Resources\ActiveKandidatResource\Api\Requests\UpdateActiveKandidatRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = ActiveKandidatResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update ActiveKandidat
     *
     * @param UpdateActiveKandidatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateActiveKandidatRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}