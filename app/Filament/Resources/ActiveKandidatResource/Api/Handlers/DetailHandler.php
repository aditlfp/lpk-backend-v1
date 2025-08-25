<?php

namespace App\Filament\Resources\ActiveKandidatResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\ActiveKandidatResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\ActiveKandidatResource\Api\Transformers\ActiveKandidatTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = ActiveKandidatResource::class;


    /**
     * Show ActiveKandidat
     *
     * @param Request $request
     * @return ActiveKandidatTransformer
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

        return new ActiveKandidatTransformer($query);
    }
}
