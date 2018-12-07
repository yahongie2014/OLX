<?php

namespace App\Http\Resources;

use App\Models\Advertising;
use App\Models\BankAccounts;
use App\Models\OrderItmes;
use App\Models\Rates;
use App\Order_status;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $company = User::select("*")
            ->join('products','products.user_id','=','users.id')
            ->join('advertisings','advertisings.user_id','=','users.id')
            ->join('order_items','order_items.product_id','=','products.id')
            ->join('orders','orders.id','=','order_items.order_id')
            ->where('orders.id',$this->id)
            ->get();

        $viewer = Advertising::select("*")
            ->join('ads_products','ads_products.ads_id','=','advertisings.id')
            ->join('products','products.id','=','ads_products.product_id')
            ->join('order_items','order_items.product_id','=','products.id')
            ->join('orders','orders.id','=','order_items.order_id')
            ->where('orders.id',$this->id)
            ->get();

        return [
            "Identifier" => $this->id,
            "CompanyName" => $company[0]["name"],
            "CompanyImage" => url(Storage::url('Avatar/'. $company[0]["image"])),
            "customerName" => Auth::user()->name,
            "customerImage" => url(Storage::url('Avatar/'. Auth::user()->image)),
            "OrderStatus" => OrderStatus::collection(Order_status::where("order_id",$this->id)->get()),
            "Rating" => (float)Rates::where("vendor_id",$company[0]["id"])->avg("average"),
            "Viewers" => (int)$viewer[0]["viewer"],
            "OrderNumber" => "#" . $this->order_number,
            "PromoCode" => (boolean)$this->promo_code_id,
            "CompanyAccounts" => BankApi::collection(BankAccounts::where("user_id",$company[0]->id)->get()),
            "OrderItems" => OrdersItemsApi::collection(OrderItmes::with("Products")
                ->where("order_id", $this->id)
                ->get()),
            "TotalPrice" => $this->total,
            "CreateIn" => $this->created_at,

        ];


    }
}
