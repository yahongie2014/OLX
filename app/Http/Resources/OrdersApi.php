<?php

namespace App\Http\Resources;

use App\Models\OrderItmes;
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
        $lol = OrderItmes::select("*")
            ->leftjoin("products", "products.id", "=", "order_items.product_id")
            ->leftjoin("users", "users.id", "=", "products.user_id")
            ->leftjoin("advertisings","advertisings.user_id","=","users.id")
            ->where("advertisings.user_id", Auth::user()->id)
            ->select("users.name")
            ->get();

        return [
            "Identifier" => $this->id,
            "companyName" => $lol[0]->name,
            "OrderStatus" => $this->status,
            "UserName" => $this->user->name,
            "OrderNumber" => "#" . $this->order_number,
            "PromoCode" => (boolean)$this->promo_code_id,
            "OrderItems" => OrdersItemsApi::collection(OrderItmes::select("*")
                ->leftJoin("products","products.id","=","order_items.product_id")
                ->where("order_id", $this->id)
                ->where("products.user_id", Auth::user()->id)
                ->get()),
            "ProductsPrice" => $this->total,
            "PercentageWebsite" => env("PERCENTAGE") . "%",
            "TotalPrice" => $this->total + $this->total * env("PERCENTAGE") / 100,
        ];


    }
}
