<?php
namespace App\Filament\Resources\PostVideoYoutubeResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PostVideoYoutubeResource;
use App\Filament\Resources\PostVideoYoutubeResource\Api\Requests\CreatePostVideoYoutubeRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PostVideoYoutubeResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create PostVideoYoutube
     *
     * @param CreatePostVideoYoutubeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePostVideoYoutubeRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}