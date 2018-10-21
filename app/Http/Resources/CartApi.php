<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartApi extends JsonResource
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
            "Identifier" => $this->id,
            "ProductName" => $this->Product->name,
            "ProductImage" => url(Storage::url('Products/'. $this->Product->cover_image)),
            "ProductPrice" => $this->Product->price,
            "UserName" => $this->users->name,
            "UserImage" => $this->users->image,
            "Quantity" => $this->qty,
            "Total" => $this->Product->price * $this->qty,
        ];
    }
}
