<?php
namespace App\Filament\Resources\ActiveKandidatResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ActiveKandidat;

/**
 * @property ActiveKandidat $resource
 */
class ActiveKandidatTransformer extends JsonResource
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
