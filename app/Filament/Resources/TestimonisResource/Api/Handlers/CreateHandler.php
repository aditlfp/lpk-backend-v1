<?php
namespace App\Filament\Resources\TestimonisResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\TestimonisResource;
use App\Filament\Resources\TestimonisResource\Api\Requests\CreateTestimonisRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = TestimonisResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Testimonis
     *
     * @param CreateTestimonisRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateTestimonisRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}