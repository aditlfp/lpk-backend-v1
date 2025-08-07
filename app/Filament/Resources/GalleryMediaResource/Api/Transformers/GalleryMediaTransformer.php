<?php
namespace App\Filament\Resources\GalleryMediaResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\GalleryMedia;

/**
 * @property GalleryMedia $resource
 */
class GalleryMediaTransformer extends JsonResource
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
