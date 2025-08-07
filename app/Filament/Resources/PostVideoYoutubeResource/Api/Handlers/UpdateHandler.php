<?php
namespace App\Filament\Resources\PostVideoYoutubeResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PostVideoYoutubeResource;
use App\Filament\Resources\PostVideoYoutubeResource\Api\Requests\UpdatePostVideoYoutubeRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PostVideoYoutubeResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update PostVideoYoutube
     *
     * @param UpdatePostVideoYoutubeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePostVideoYoutubeRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}