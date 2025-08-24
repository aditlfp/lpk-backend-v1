<?php

namespace App\Filament\Resources\LpkClassResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\LpkClassResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\LpkClassResource\Api\Transformers\LpkClassTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = LpkClassResource::class;


    /**
     * Show LpkClass
     *
     * @param Request $request
     * @return LpkClassTransformer
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

        return new LpkClassTransformer($query);
    }
}
