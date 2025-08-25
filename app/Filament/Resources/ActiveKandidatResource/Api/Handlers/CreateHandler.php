<?php
namespace App\Filament\Resources\ActiveKandidatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ActiveKandidatResource;
use App\Filament\Resources\ActiveKandidatResource\Api\Requests\CreateActiveKandidatRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ActiveKandidatResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create ActiveKandidat
     *
     * @param CreateActiveKandidatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateActiveKandidatRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}