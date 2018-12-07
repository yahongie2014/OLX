<?php

namespace App\Http\Resources;

use App\Models\AdsCities;
use App\Models\AdsImages;
use App\Models\AdsProducts;
use App\Models\Rates;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            "CompanyName" => $this->users->name,
            "CompanyImage" => url(Storage::url('Avatar/'. $this->users->image)),
            "Rating" => (float)Rates::where("vendor_id",$this->users->id)->avg("average"),
            "Company Info" => $this->desc,
            "Viewers Count" => (int)$this->viewer,
            "ServicesId" => $this->services->id,
            "ServicesName" => $this->services->name,
            "ServicesChildId" => $this->subservices->id,
            "ServicesChildName" => $this->subservices->name,
            "Delivery Available" => (boolean)$this->is_delivery,
            "Percentage" => $this->percentage,
            "CreatedIn" => $this->created_at,
            "MainImage" => url(Storage::url('AdsImages/'. $this->cover_image)),
            "AdsImages" => AdsImagesApi::collection(AdsImages::with("Adsimage")->where("ads_id",$this->id)->whereNull('deleted_at')->get()),
            "CitiesAvailable" => AdsCitiesApi::collection(AdsCities::with("Adscity")->where("ads_id",$this->id)->get()),
            "Products" => AdsProductApi::collection(AdsProducts::with("Adsproducts")->where("ads_id",$this->id)->whereNull('deleted_at')->get()),
        ];
    }
}
