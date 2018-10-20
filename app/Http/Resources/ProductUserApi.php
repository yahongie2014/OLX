<?php

namespace App\Http\Resources;

use App\Models\ProductsImages;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductUserApi extends JsonResource
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
            "Descereption" => $this->desc,
            "CompanyOwner" => $this->users->name,
            "CompanyImage" => $this->users->image,
            "Price" => $this->price,
            "Status" => $this->is_active,
            "Cover" =>  url('/storage/app/public/Products/'.$this->cover_image),
            "FeatureImages" =>  ProductImageApi::collection(ProductsImages::with("ImgPro")->where("products_id",$this->id)->get()),
            "Time" => $this->created_at,
        ];
    }
}
