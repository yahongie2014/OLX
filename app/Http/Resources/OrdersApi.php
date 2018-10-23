<?php

namespace App\Http\Resources;

use App\Models\Advertising;
use App\Models\OrderItmes;
use App\Models\Products;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OrdersApi extends JsonResource
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
            "OrderStatus" => $this->status,
            "OrderNumber" => "#" . $this->order_number,
            "PromoCode" => (boolean)$this->promo_code_id,
            "OrderItems" => OrdersItemsApi::collection(OrderItmes::with(["Products" => function ($q) {
                $q->select("products.id");
                $q->where("products.id", Auth::user()->id);
            }])
                ->where("order_id", $this->id)
                ->get()),
            "ProductsPrice" => $this->total,
            "PercentageWebsite" => env("PERCENTAGE") . "%",
            "TotalPrice" => $this->total + $this->total * env("PERCENTAGE") / 100,
        ];


    }
}
