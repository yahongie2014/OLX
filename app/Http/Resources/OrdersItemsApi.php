<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            "OrderRelated" => $this->order_id,
            "ProductName" => $this->Products->name,
            "ProductPrice" => $this->Products->price,
        ];
    }
}
