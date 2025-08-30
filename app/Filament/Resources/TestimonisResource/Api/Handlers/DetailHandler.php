<?php

namespace App\Filament\Resources\TestimonisResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\TestimonisResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\TestimonisResource\Api\Transformers\TestimonisTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = TestimonisResource::class;


    /**
     * Show Testimonis
     *
     * @param Request $request
     * @return TestimonisTransformer
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

        return new TestimonisTransformer($query);
    }
}
