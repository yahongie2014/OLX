<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatesForm;
use App\Http\Resources\RatesApi;
use App\Models\Rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RatesController extends Controller
{
    public function __construct(Rates $rates)
    {
        App::setLocale("ar");
        $this->middleware('auth:api');
        $this->rate = $rates;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return RatesApi::collection($this->rate->where("user_id",$request->user()->id)->paginate());
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
    public function store(RatesForm $request)
    {
        if ($request->user()->id != $request->user_id) {
            return response()->json(['error' => 'You cant create any Rate for Other User'], 403);
        }
        $rates = new $this->rate($request->all());

        $rate = new $this->rate();
        $rate->user_type = $request->user()->is_vendor;
        $rate->update();
        DB::commit();
        return new RatesApi($rates);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rates  $rates
     * @return \Illuminate\Http\Response
     */
    public function show(Rates $rates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rates  $rates
     * @return \Illuminate\Http\Response
     */
    public function edit(Rates $rates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rates  $rates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rates $rates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rates  $rates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:products,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );

        if($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        }else{
            $soft = $this->rate->findOrFail($id);
            if ($request->user()->id != $soft->user_id) {
                return response()->json(['error' => 'You can only delete your Rate Service.'], 403);
            }
            $soft->delete();

            return response()->json(["message" => "Your Rate Was Deleted"]);
        }
    }
}
