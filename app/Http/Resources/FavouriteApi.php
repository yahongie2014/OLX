<?php

namespace App\Http\Resources;

use App\Models\Advertising;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteApi extends JsonResource
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
            "Services" => $this->services->desc,
            "UserName" => $this->users->name,
            "Created in" => $this->created_at,
            "Ads" => AdsUerApi::collection(Advertising::where("id",$this->ads_id)->get())
        ];
    }
}
