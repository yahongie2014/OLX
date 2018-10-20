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
            "Identifier" => $this->Products->id,
            "ProductName" => $this->Products->name,
            "ProductPrice" => $this->Products->price,
            "ProductInfo" => $this->Products->desc,
            "ProductImage" => url('/storage/app/public/Products/'. $this->Products->cover_image),
        ];
    }
}
