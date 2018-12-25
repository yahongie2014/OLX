<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubServicesApi;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SubServicesController extends Controller
{
    public function __construct(SubServices $sub)
    {
        App::setLocale(env("LOCALE"));

        $this->sub = $sub;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubServicesApi::collection($this->sub->whereNull('deleted_at')->get());

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
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:countries,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        }else {

            return new SubServicesApi($this->sub->findOrFail($id));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function edit(SubServices $subServices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubServices $subServices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubServices  $subServices
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubServices $subServices)
    {
        //
    }
}
