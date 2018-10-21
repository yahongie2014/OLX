<?php

namespace App\Http\Resources;

use App\Models\OrderItmes;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersApi extends JsonResource
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
            "OrderStatus" => $this->status,
            "UserName" => $this->user->name,
            "OrderNumber" => "#".$this->order_number,
            "PromoCode" => (boolean)$this->promo_code_id,
            "OrderItems" => OrdersItemsApi::collection(OrderItmes::with("Products")->where("order_id",$this->id)->get()),
            "TotalPrice" => $this->total(),
        ];
    }
}
