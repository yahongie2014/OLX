<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdsForm;
use App\Http\Resources\AdsApi;
use App\Http\Resources\AdsUerApi;
use App\Models\AdsCities;
use App\Models\AdsProducts;
use App\Models\Advertising;
use App\Models\AdvertisingTranslation;
use Illuminate\Http\Request;

class AdsUserController extends Controller
{
    public function __construct(Advertising $ads)
    {
        $this->ads = $ads;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->city){
            $ads = $this->ads->select("*")
                ->leftjoin("ads_cities","ads_cities.ads_id","=","advertisings.id")
                ->where("ads_cities.city_id",'LIKE', '%' ."$request->city")
                ->get();
            foreach ($ads as $ad)
                return AdsUerApi::collection($this->ads->whereNull('deleted_at')->where("id", $ad->id)->paginate());
        }elseif($request->name){
            $adsss = $this->ads->select("*")
                ->leftjoin("ads_products","ads_products.ads_id","=","advertisings.id")
                ->leftjoin("products","products.products","=","ads_products.ads_id")
                ->leftjoin("products_translations","products_translations.products_id","=","products.id")
                ->where("products_translations.name", 'LIKE', '%' . $request->name . '%')
                ->get();
            foreach ($adsss as $adi)
                return AdsApi::collection($this->ads->whereNull('deleted_at')->where("id", $adi->id)->paginate());
        }elseif ($request->orderd){
            $adsss_order = $this->ads->select("*")
                ->leftjoin("ads_products","ads_products.ads_id","=","advertisings.id")
                ->leftjoin("products","products.id","=","ads_products.ads_id")
                ->leftjoin("products_translations","products_translations.products_id","=","products.id")
                ->where("products_translations.price", 'LIKE', '%' . $request->orderd . '%')
                ->get();
            foreach ($adsss_order as $adi_o)
                return AdsApi::collection($this->ads->whereNull('deleted_at')->where("id", $adi_o)->paginate());
        }
        return AdsUerApi::collection($this->ads->with("users")->whereNull('deleted_at')->paginate());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:advertisings,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $only = $this->ads->findOrFail($id);
            $only->viewer = $only->viewer +1 ;
            $only->update();

            return new AdsUerApi($only);
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
