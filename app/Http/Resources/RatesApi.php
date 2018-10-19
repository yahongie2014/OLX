<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatesApi extends JsonResource
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
            "Identifier" => (int)$this->id,
            "Services Name" => (string)$this->ads->desc,
            "UserName" => (string)$this->users->name,
            "UserType" => (int)$this->user_type,
            "Average" => (int)$this->average,
        ];
    }
}
