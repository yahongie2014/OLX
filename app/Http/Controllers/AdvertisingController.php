<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Http\Requests\AdsForm;
use App\Http\Resources\AdsApi;
use App\Models\AdsCities;
use App\Models\AdsImages;
use App\Models\AdsProducts;
use App\Models\Advertising;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AdvertisingController extends Controller
{
    public function __construct(Advertising $ads, AdsProducts $adproducts, AdsCities $city_id, AdsImages $images)
    {
        //   App::setLocale(env("LOCALE"));
        $this->middleware('auth:api');
        $this->ads = $ads;
        $this->adproducts = $adproducts;
        $this->city_id = $city_id;
        $this->images = $images;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return AdsApi::collection($this->ads->with("users")->where("user_id", $request->user()->id)->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsForm $request)
    {
        $ads = new $this->ads($request->all());
        $ads->user_id = $request->user()->id;
        if ($ads->save()) {
            $product_id = $request->products;
            for ($i = 0; $i < count($product_id); $i++) {
                $adpro = new $this->adproducts($request->all());
                $adpro->ads_id = $ads->id;
                $adpro->product_id = $product_id[$i];
                $adpro->save();
            }
            $city_id = $request->cities;
            for ($i = 0; $i < count($city_id); $i++) {
                $city = new $this->city_id($request->all());
                $city->ads_id = $ads->id;
                $city->city_id = $city_id[$i];
                $city->save();
            }

            $file = $request->file('Images');
            for ($i = 0; $i < count($file); $i++) {
                $name_pic = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $name = Storage::putFileAs('/public/AdsImages', $file, $name_pic);
                $img = new $this->images($request->all());
                $img->ads_id = $ads->id;
                $img->path = $name_pic[$i];
                $img->save();
            }


            DB::commit();
        }

        return new AdsApi($ads);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertising $advertising
     * @return \Illuminate\Http\Response
     */
    public function show(Advertising $advertising)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertising $advertising
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertising $advertising)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Advertising $advertising
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertising $advertising)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertising $advertising
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:advertisings,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $soft = $this->ads->findOrFail($id);
            if ($request->user()->id !== $soft->user_id) {
                return response()->json(['error' => 'You can only delete your Ads.'], 403);
            }
            $soft->delete();

            return response()->json(["message" => "Ads $soft->name IS Deleted"]);
        }

    }
}
