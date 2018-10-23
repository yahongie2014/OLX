<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Http\Requests\AdsForm;
use App\Http\Resources\AdsApi;
use App\Models\AdsCities;
use App\Models\AdsImages;
use App\Models\AdsProducts;
use App\Models\Advertising;
use App\Models\AdvertisingTranslation;
use App\Models\Products;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AdvertisingController extends Controller
{
    public function __construct(Advertising $ads, AdsProducts $adproducts, AdsCities $city_id, AdsImages $images, AdvertisingTranslation $trnsalator)
    {
        //   App::setLocale(env("LOCALE"));
        $this->middleware('auth:api');
        $this->ads = $ads;
        $this->adproducts = $adproducts;
        $this->city_id = $city_id;
        $this->images = $images;
        $this->trnslator = $trnsalator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return AdsApi::collection($this->ads->with("users")->whereNull('deleted_at')->where("user_id", $request->user()->id)->paginate());
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
        $product_id = $request->products;

        $pros = Products::where('id', $product_id)->get();
        foreach ($pros as $key) {
            if ($request->user()->id !== $key->user_id) {
                return response()->json(['error' => 'You can only add your Products.'], 403);
            }
        }

        if ($request->locale_ar) {

            $rules = array(
                'desc_ar' => 'required',
                'locale_ar' => 'required',
            );
            $messages = array(
                'desc_ar.required' => 'Arabic Info Required',
            );
            $validator = \Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()])->setStatusCode(422);
            }
        }

        $ads = new $this->ads($request->all());
        $ads->user_id = $request->user()->id;
        if ($ads->save()) {
            foreach ($product_id as $items) {
                $adpro = new $this->adproducts($request->all());
                $adpro->ads_id = $ads->id;
                $adpro->product_id = $items;
                $adpro->save();
            }
            $city_id = $request->cities;
            for ($i = 0; $i < count($city_id); $i++) {
                $city = new $this->city_id($request->all());
                $city->ads_id = $ads->id;
                $city->city_id = $city_id[$i];
                $city->save();
            }

            $file_make = $request->file('Images');
            foreach ($file_make as $files) {
                $name_image = $files->getClientOriginalName();
                $ext = $files->getClientOriginalExtension();
                $name = Storage::putFileAs('/public/AdsImages', $files, $name_image);
                $img = new $this->images($request->all());
                $img->ads_id = $ads->id;
                $img->path = $name_image;
                $img->save();
            }
            if ($request->locale_ar) {
                $ads_tr = new $this->trnslator();
                $ads_tr->advertising_id = $ads->id;
                $ads_tr->percentage = $ads->percentage;
                $ads_tr->is_delivery = $ads->is_delivery;
                $ads_tr->locale = $request->locale_ar;
                $ads_tr->desc = $request->desc_ar;
                $ads_tr->save();
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
    public function show(Request $request, $id)
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
            $only = $this->ads->findOrFail($id);
            $only->viewer = $only->viewer + 1;
            $only->update();

            if ($request->user()->id !== $only->user_id) {
                return response()->json(['error' => 'You can only show your Advertising.'], 403);
            }

            return new AdsApi($only->whereNull('deleted_at'));
        }

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
            $mage_path = $this->images->where("ads_id", $id)->get();
            foreach ($mage_path as $items) {
                $single = $this->images->findOrFail($items->id);
                $single->delete();
            }
            $mage_pro = $this->adproducts->where("ads_id", $id)->get();
            foreach ($mage_pro as $items) {
                $single = $this->adproducts->findOrFail($items->id);
                $single->delete();
            }
            $mage_pro = $this->city_id->where("ads_id", $id)->get();
            foreach ($mage_pro as $items) {
                $single = $this->city_id->findOrFail($items->id);
                $single->delete();
            }
            $mage_trnslate = $this->trnslator->where("advertising_id", $id)->get();
            foreach ($mage_trnslate as $items) {
                $single = $this->trnslator->findOrFail($items->id);
                $single->delete();
            }

            $soft->delete();
            DB::commit();
            return response()->json(["message" => "Ads $soft->desc IS Deleted"]);
        }

    }
}
