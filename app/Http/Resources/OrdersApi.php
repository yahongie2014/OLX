<?php

namespace App\Http\Resources;

use App\Models\Advertising;
use App\Models\OrderItmes;
use App\Models\Products;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $orders_d = OrderItmes::select("*")
            ->leftjoin("products", "products.id", "=", "order_items.product_id")
            ->where("products.user_id", $request->user()->id)
            ->where("order_items.order_id", $this->id)
            ->get();

        $orders = OrderItmes::select("*")
            ->leftjoin("products", "products.id", "=", "order_items.product_id")
            ->where("products.user_id", $request->user()->id)
            ->sum(DB::raw('order_items.price * order_items.qty'));
        $percent = $orders * env("PERCENTAGE") / 100;


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
            "OrderItems" => OrdersItemsApi::collection($orders_d),
            "TotalProfit" => $orders,
            "WebsiteMustPaid" => $percent,
            "PercentageWebsite" => env("PERCENTAGE") . "%",
        ];


    }
}
