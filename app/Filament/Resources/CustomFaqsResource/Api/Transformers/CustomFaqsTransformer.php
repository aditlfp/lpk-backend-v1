<?php
namespace App\Filament\Resources\CustomFaqsResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\CustomFaqs;

/**
 * @property CustomFaqs $resource
 */
class CustomFaqsTransformer extends JsonResource
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
