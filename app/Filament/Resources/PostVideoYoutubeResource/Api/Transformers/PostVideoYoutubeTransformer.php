<?php
namespace App\Filament\Resources\PostVideoYoutubeResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PostVideoYoutube;

/**
 * @property PostVideoYoutube $resource
 */
class PostVideoYoutubeTransformer extends JsonResource
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
