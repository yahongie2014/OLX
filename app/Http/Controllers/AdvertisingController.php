<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdsApi;
use App\Models\Advertising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdvertisingController extends Controller
{
    public function __construct(Advertising $ads)
    {
     //   App::setLocale(env("LOCALE"));
        $this->ads = $ads;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return AdsApi::collection($this->ads->with("users")->where("user_id",$request->user()->id)->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function show(Advertising $advertising)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertising $advertising)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertising $advertising)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
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

        if($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        }else{
            $soft = $this->ads->findOrFail($id);
            if ($request->user()->id !== $soft->user_id) {
                return response()->json(['error' => 'You can only delete your Ads.'], 403);
            }
            $soft->delete();

            return response()->json(["message" => "Ads $soft->name IS Deleted"]);
        }

    }
}
