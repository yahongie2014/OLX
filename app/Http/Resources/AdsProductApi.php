<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsProductApi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "ProductName" => $this->Products->name,
            "ProductImage" => url('/storage/app/public/Products/'. $this->Products->cover_image),
        ];
    }
}
