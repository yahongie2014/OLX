<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactAPi extends JsonResource
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
            "Facebook" => $this->fb,
            "Twitter" => $this->tw,
            "Phone" => $this->phone,
            "Address" => $this->address,
            "Fax" => $this->fax,
        ];
    }
}
