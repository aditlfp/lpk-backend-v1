<?php
namespace App\Filament\Resources\SswFieldResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\SswField;

/**
 * @property SswField $resource
 */
class SswFieldTransformer extends JsonResource
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
