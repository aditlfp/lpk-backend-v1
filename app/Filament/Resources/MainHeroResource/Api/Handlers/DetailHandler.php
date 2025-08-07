<?php

namespace App\Filament\Resources\MainHeroResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\MainHeroResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\MainHeroResource\Api\Transformers\MainHeroTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = MainHeroResource::class;


    /**
     * Show MainHero
     *
     * @param Request $request
     * @return MainHeroTransformer
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

        return new MainHeroTransformer($query);
    }
}
