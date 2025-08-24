<?php
namespace App\Filament\Resources\CommentResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Comments;

/**
 * @property Comment $resource
 */
class CommentTransformer extends JsonResource
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
