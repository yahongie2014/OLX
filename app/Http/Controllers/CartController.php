<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartForm;
use App\Http\Resources\CartApi;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(Cart $cart, Products $product)
    {
        $this->middleware('auth:api');
        $this->cart = $cart;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return CartApi::collection($this->cart->where("user_id", $request->user()->id)->paginate());
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
    public function store(CartForm $request)
    {
        $count = $this->cart->where('product_id', '=', $request->product_id)->where('user_id', '=', $request->user()->id)->count();

        if ($count){
            return response()->json(["message" => "The given data was invalid",'errors' => 'product already in your cart'])->setStatusCode(400);
        }
        $cart = new $this->cart($request->all());
        $product = $this->product->find($request->product_id);
        $cart->price = $product->price * $request->qty;
        $cart->user_id = $request->user()->id;
        $cart->save();
        return new CartApi($cart);
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
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CartForm $request, $id)
    {
        $cart =  $this->cart->findOrFail($id);
        $product = $this->product->find($request->product_id);
        $cart->price = $product->price * $request->qty;
        $cart->qty = $request->qty;
        $cart->user_id = $request->user()->id;
        $cart->update();

        return new CartApi($cart);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:cart,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $soft = $this->cart->findOrFail($id);
            if ($request->user()->id !== $soft->user_id) {
                return response()->json(['error' => 'You can only delete your Crt Item.'], 403);
            }
            $soft->delete();

            return response()->json(["message" => "Item IS Deleted"]);
        }
    }
}
