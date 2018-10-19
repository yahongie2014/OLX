<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicesApi extends JsonResource
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
            "Name" => $this->name,
            "Descerption" => $this->desc,
            "Icon" => url('/storage/app/public/Services/'.$this->icon),
            "Status" => $this->is_active,
            "longitude" => $this->longitude,
            "latitudes" => $this->latitudes,
            "child" => $this->sub_service,
        ];
    }
}
