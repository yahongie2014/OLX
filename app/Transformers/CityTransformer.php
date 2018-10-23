<?php
namespace App\Transformers;

use App\Cities;
use League\Fractal\TransformerAbstract;

class CityTransformer extends TransformerAbstract
{


    public function transform(Cities $city)
    {
        return [
            'id' => $city->id,
            'name' => $city->name,
            'country' => $city->country->name,
        ];
    }


}
?>