<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdersForm;
use App\Http\Resources\OrdersApi;
use App\Models\Cart;
use App\Models\OrderItmes;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersUserController extends Controller
{
    public function __construct(Orders $orders, Cart $cart, OrderItmes $ord_item)
    {
        $this->middleware('auth:api');
        $this->orders = $orders;
        $this->cart = $cart;
        $this->ord_item = $ord_item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return OrdersApi::collection($this->orders->where("user_id", $request->user()->id)->paginate());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdersForm $request)
    {
        $cart_item = $this->cart->where("user_id", $request->user()->id)->get();
//        if ($cart_item != '') {
//            return response()->json(["message" => "The given data was invalid", "errors" => "No Cart Item"]);
//        }
        $make = new $this->orders($request->all());
        $generated = rand(2222235, 8787878);
        $total = $this->cart->where("user_id", $request->user()->id)->groupBy("user_id")->sum("price");
        $make->user_id = $request->user()->id;
        $make->order_number = $generated;
        $make->promo_code_id = 0;
        $make->total = $total;
        if ($make->save()) {
            foreach ($cart_item as $items) {
                $order = new $this->ord_item();
                $order->qty = $items->qty;
                $order->price = $items->Product->price;
                $order->product_id = $items->product_id;
                $order->order_id = $make->id;
                $order->order_long = $request->order_long;
                $order->order_lat = $request->order_lat;
                if ($order->save()) {
                    $items->delete();
                }
            }

        }
        DB::commit();
        return new OrdersApi($make);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
