<?php
namespace App\Filament\Resources\CustomFaqsResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\CustomFaqsResource;
use App\Filament\Resources\CustomFaqsResource\Api\Requests\CreateCustomFaqsRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = CustomFaqsResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create CustomFaqs
     *
     * @param CreateCustomFaqsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateCustomFaqsRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}