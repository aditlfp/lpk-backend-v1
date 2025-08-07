<?php
namespace App\Filament\Resources\MainHeroResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\MainHeroResource;
use App\Filament\Resources\MainHeroResource\Api\Transformers\MainHeroTransformer;

class PaginationHandler extends Handlers {
    public static bool $public = true;
    public static string | null $uri = '/';
    public static string | null $resource = MainHeroResource::class;


    /**
     * List of MainHero
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
        ->allowedFields($this->getAllowedFields() ?? [])
        ->allowedSorts($this->getAllowedSorts() ?? [])
        ->allowedFilters($this->getAllowedFilters() ?? [])
        ->allowedIncludes($this->getAllowedIncludes() ?? [])
        ->paginate(request()->query('per_page'))
        ->appends(request()->query());

        return MainHeroTransformer::collection($query);
    }
}
