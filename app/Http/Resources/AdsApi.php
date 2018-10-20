<?php

namespace App\Http\Resources;

use App\Models\AdsCities;
use App\Models\AdsImages;
use App\Models\AdsProducts;
use App\Models\Rates;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsApi extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "Identifier" => $this->id,
            "Company Name" => $this->users->name,
            "Company Info" => $this->desc,
            "Viewers Count" => (int)$this->viewer,
            "ServicesName" => $this->services->name,
            "ServicesChildName" => $this->subservices->name,
            "Delivery Available" => (boolean)$this->is_delivery,
            "Percentage" => $this->percentage,
            "RateAverage" => Rates::where('ads_id', $this->id)->groupBy('ads_id')->avg('average'),
            "AdsImages" => AdsImagesApi::collection(AdsImages::with("Adsimage")->where("ads_id",$this->id)->get()),
            "CitiesAvailable" => AdsCitiesApi::collection(AdsCities::with("Adscity")->where("ads_id",$this->id)->get()),
            "Products" => AdsProductApi::collection(AdsProducts::with("Adsproducts")->where("ads_id",$this->id)->get()),
        ];
    }
}
