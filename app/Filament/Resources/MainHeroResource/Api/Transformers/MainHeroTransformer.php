<?php
namespace App\Filament\Resources\MainHeroResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MainHero;

/**
 * @property MainHero $resource
 */
class MainHeroTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
