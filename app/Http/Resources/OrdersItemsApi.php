<?php

namespace App\Http\Resources;

use App\Models\OrderItmes;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OrdersItemsApi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            "Identifier" => $this->id,
            "ProductName" => $this->Products["name"],
            "ProductImage" => url(Storage::url('Products/'. $this->Products["cover_image"])),
            "ProductPrice" => $this->Products["price"],
            "Quantity" => $this->qty,
            "OrderLang" => $this->order_long,
            "OrderLat" => $this->order_lat,
        ];
    }
}
