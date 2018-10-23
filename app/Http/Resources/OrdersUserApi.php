<?php

namespace App\Http\Resources;

use App\Models\OrderItmes;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OrdersUserApi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "Identifier" => $this->id,
            "companyName" => "Secret",
            "OrderStatus" => $this->status,
            "UserName" => $this->user->name,
            "OrderNumber" => "#" . $this->order_number,
            "PromoCode" => (boolean)$this->promo_code_id,
            "OrderItems" => OrdersItemsApi::collection(OrderItmes::with("Products")
                ->where("order_id", $this->id)
                ->get()),
            "TotalPrice" => $this->total,
        ];


    }
}
