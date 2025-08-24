<?php

namespace App\Filament\Resources\CustomFaqsResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\CustomFaqsResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\CustomFaqsResource\Api\Transformers\CustomFaqsTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = CustomFaqsResource::class;


    /**
     * Show CustomFaqs
     *
     * @param Request $request
     * @return CustomFaqsTransformer
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

        return new CustomFaqsTransformer($query);
    }
}
