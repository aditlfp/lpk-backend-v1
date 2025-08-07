<?php

namespace App\Filament\Resources\PostVideoYoutubeResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PostVideoYoutubeResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PostVideoYoutubeResource\Api\Transformers\PostVideoYoutubeTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PostVideoYoutubeResource::class;


    /**
     * Show PostVideoYoutube
     *
     * @param Request $request
     * @return PostVideoYoutubeTransformer
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

        return new PostVideoYoutubeTransformer($query);
    }
}
