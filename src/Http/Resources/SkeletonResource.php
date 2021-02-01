<?php


namespace MacsiDigital\Skeleton\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkeletonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
