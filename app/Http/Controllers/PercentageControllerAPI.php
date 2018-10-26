<?php

namespace App\Http\Controllers;

use App\Models\OrderItmes;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PercentageControllerAPI extends Controller
{
    public function __construct(OrderItmes $orderItmes)
    {
        $this->middleware("auth");
        $this->orderItmes = $orderItmes;
    }

    public function index(Request $request)
    {
        $id = $request->user()->id;
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:users,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $orders = $this->orderItmes->select("*")
                ->leftjoin("products", "products.id", "=", "order_items.product_id")
                ->where("products.user_id", $request->user()->id)
                ->sum(DB::raw('order_items.price * order_items.qty'));

            $percent = $orders * env("PERCENTAGE") / 100;

        }
        return response()->json(["messages" => __("general.percentage"), "data" => $percent]);
    }
}
