<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrdersItemsApi;
use App\Models\OrderItmes;
use Illuminate\Http\Request;

class OrderItmesController extends Controller
{
    public function __construct(OrderItmes $items)
    {
        $this->middleware('auth:api');
        $this->items = $items;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return OrdersItemsApi::collection($this->items->paginate());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItmes  $orderItmes
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItmes $orderItmes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItmes  $orderItmes
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItmes $orderItmes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItmes  $orderItmes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderItmes $orderItmes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItmes  $orderItmes
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItmes $orderItmes)
    {
        //
    }
}
