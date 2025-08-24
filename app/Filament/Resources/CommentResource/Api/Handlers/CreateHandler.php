<?php
namespace App\Filament\Resources\CommentResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\CommentResource;
use App\Filament\Resources\CommentResource\Api\Requests\CreateCommentRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = CommentResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Comment
     *
     * @param CreateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateCommentRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}