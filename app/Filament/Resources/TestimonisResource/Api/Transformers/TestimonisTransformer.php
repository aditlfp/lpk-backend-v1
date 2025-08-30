<?php
namespace App\Filament\Resources\TestimonisResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Testimonis;

/**
 * @property Testimonis $resource
 */
class TestimonisTransformer extends JsonResource
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
