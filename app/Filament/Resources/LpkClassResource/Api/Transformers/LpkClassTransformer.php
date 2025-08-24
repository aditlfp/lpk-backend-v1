<?php
namespace App\Filament\Resources\LpkClassResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\LpkClass;

/**
 * @property LpkClass $resource
 */
class LpkClassTransformer extends JsonResource
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
