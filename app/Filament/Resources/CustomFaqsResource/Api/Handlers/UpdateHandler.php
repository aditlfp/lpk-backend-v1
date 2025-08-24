<?php
namespace App\Filament\Resources\CustomFaqsResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\CustomFaqsResource;
use App\Filament\Resources\CustomFaqsResource\Api\Requests\UpdateCustomFaqsRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = CustomFaqsResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update CustomFaqs
     *
     * @param UpdateCustomFaqsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateCustomFaqsRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}