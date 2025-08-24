<?php

namespace App\Filament\Resources\CommentResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\CommentResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\CommentResource\Api\Transformers\CommentTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = CommentResource::class;


    /**
     * Show Comment
     *
     * @param Request $request
     * @return CommentTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new CommentTransformer($query);
    }
}
