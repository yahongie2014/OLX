<?php

namespace App\Http\Resources;

use App\Cities;
use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserProfile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $citites = Cities::where("id",$this->city_id)->get();
        foreach ($citites as $citite)
        return [
            "id" => $this->id,
            "name" => $this->name,
            "phone" => $this->phone,
            "email" => $this->email,
            "image" => Storage::path("$this->image"),
            "longitude" => $this->longitude,
            "latitudes" => $this->latitudes,
            "City" => $this->city_id,
            "Country" => $citite->country_id,
        ];
    }
}
