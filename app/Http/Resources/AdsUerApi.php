<?php

namespace App\Http\Resources;

use App\Models\AdsCities;
use App\Models\AdsImages;
use App\Models\AdsProducts;
use App\Models\Bookmark;
use App\Models\Rates;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdsUerApi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $book = Bookmark::where("user_id",Auth::user()->id)->where("ads_id",$this->id)->whereNull("deleted_at")->count();

        if($book == 0){
            $val = false;
        }else{
            $val= true;
        }

        $book_id = Bookmark::where('ads_id',$this->id)->get();
        return [
            "Identifier" => $this->id,
            "BookmarkedId" => $book_id,
            "IsBookmarked" => $val,
            "CompanyName" => $this->users->name,
            "Subscribe" => (boolean)$this->is_subscribe,
            "CompanyImage" => url(Storage::url('Avatar/'. $this->users->image)),
            "CompanyInfo" => $this->desc,
            "Rating" => (float)Rates::where("vendor_id",$this->user_id)->avg("average"),
            "Viewers Count" => (int)$this->viewer,
            "ServicesName" => $this->services->name,
            "ServicesChildName" => $this->subservices->name,
            "Delivery Available" => (boolean)$this->is_delivery,
            "Percentage" => $this->percentage,
            "CreatedIn" => $this->created_at,
            "MainImage" => url(Storage::url('AdsImages/'. $this->cover_image)),
            "AdsImages" => AdsImagesApi::collection(AdsImages::with("Adsimage")->where("ads_id",$this->id)->whereNull('deleted_at')->get()),
            "CitiesAvailable" => AdsCitiesApi::collection(AdsCities::with("Adscity")->where("ads_id",$this->id)->get()),
            "Products" => AdsProductApi::collection(AdsProducts::with("Products")->where("ads_id",$this->id)->whereNull('deleted_at')->get()),
        ];
    }
}
