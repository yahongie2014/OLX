<?php

namespace App\Http\Controllers;

use App\Cities;

use App\Http\Resources\CityTransformer;
use Illuminate\Http\Request;

class SingleJsonController extends Controller
{
    public function __construct(Cities $cites)
    {
        $this->cities = $cites;
    }

   public function city(Request $request)
    {

        $cities = CityTransformer::collection($this->cities->with("country")->where('country_id', $request->country_id)->get());

        return response()->json(['status' => true, 'result' => $cities]);

    }


}
