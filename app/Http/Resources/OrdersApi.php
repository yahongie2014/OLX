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
            "WebSiteName" => env('APP_NAME', 'At Time'),
            "OrderStatus" => $this->status,
            "CompanyName" => Auth::user()->name,
            "CompanyImage" => Auth::user()->image,
            "CustomerName" => $this->user->name,
            "CustomerImage" => $this->user->image,
            "OrderNumber" => "#" . $this->order_number,
            "PromoCode" => (boolean)$this->promo_code_id,
            "OrderItems" => OrdersItemsApi::collection(OrderItmes::with(["Products" => function ($q) {
                $q->select("products.id");
                $q->groupBy("products.id");
                $q->where("products.user_id", Auth::user()->id);}])
                ->where("order_id", $this->id)
                ->whereNotNull("price")
                ->get()),
            "PercentageWebsite" => env("PERCENTAGE") . "%",
        ];


    }
}
