<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdsApi;
use App\Models\AdsCities;
use App\Models\AdsImages;
use App\Models\AdsProducts;
use App\Models\Advertising;
use App\Models\AdvertisingTranslation;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(Advertising $ads, AdsProducts $adproducts, AdsCities $city_id, AdsImages $images, AdvertisingTranslation $trnsalator,Request $request)
    {
        $this->middleware('auth:api');
        $this->ads = $ads;
        $this->adproducts = $adproducts;
        $this->city_id = $city_id;
        $this->images = $images;
        $this->trnslator = $trnsalator;
    }

    public function index(Request $request)
    {
        if($request->city && $request->service && $request->name){
            $ads = $this->ads->select("*")
                ->leftjoin("ads_cities","ads_cities.ads_id","=","advertisings.id")
                ->leftjoin("services","services.id","=","advertisings.services_id")
                ->leftjoin("services_translations","services_translations.services_id","=","services.id")
                ->where("services_translations.name", 'LIKE', '%' . $request->name . '%')
                ->where("ads_cities.city_id",'LIKE', '%' ."$request->city")
                ->where("advertisings.subservices_id", 'LIKE', '%' . $request->service . '%')
                ->get();
            foreach ($ads as $ad)
                return AdsApi::collection($this->ads->whereNull('deleted_at')->where("id", $ad->id)->paginate());
        }elseif ($request->city){
            $ads = $this->ads->select("*")
                ->leftjoin("ads_cities","ads_cities.ads_id","=","advertisings.id")
                ->where("ads_cities.city_id",'LIKE', '%' ."$request->city")
                ->get();
            foreach ($ads as $ad)
                return AdsApi::collection($this->ads->whereNull('deleted_at')->where("id", $ad->id)->paginate());
        }elseif ($request->name){
            $adsss = $this->ads->select("*")
                ->leftjoin("ads_cities","ads_cities.ads_id","=","advertisings.id")
                ->leftjoin("services","services.id","=","advertisings.services_id")
                ->leftjoin("services_translations","services_translations.services_id","=","services.id")
                ->where("services_translations.name", 'LIKE', '%' . $request->name . '%')
                ->get();
            foreach ($adsss as $adi)
                return AdsApi::collection($this->ads->whereNull('deleted_at')->where("id", $adi->id)->paginate());
        }elseif ($request->service){
            $ads_service = $this->ads->select("*")
                ->leftjoin("ads_cities","ads_cities.ads_id","=","advertisings.id")
                ->where("advertisings.subservices_id", 'LIKE', '%' . $request->service . '%')
                ->get();
            foreach ($ads_service as $adssq)
                return AdsApi::collection($this->ads->whereNull('deleted_at')->where("id", $adssq->id)->paginate());
        }
        return response()->json(["message" => __("general.search"),"error" => "no data found"]);
    }
}
