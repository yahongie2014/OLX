<?php

namespace App\Http\Controllers;


use App\Cities;
use App\Http\Resources\CityTransformer;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use App\Language;

use Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(Auth::user())
            $language_id = Auth::user()->language_id;
        else
            $language_id = Language::where('default' ,DEFAULT_LANGUAGE)->first(['id'])->id;

        $cities = Cities::with('country')->whereHas('translations');



        if($request->has('country_id'))
            $cities = $cities->where('country_id',$request->country_id);


        $cities = $cities->get();

        if(Request()->expectsJson()){
            $cities = CityTransformer::collection($this->cities->with("country")->whereHas('translations')->where('country_id', $request->country_id)->get());

            return response() ->json(['status' => true , 'result' => $cities->toArray() ]);
        }

        return view('admin.city.index')
            ->with([
                'cities' => $cities,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $languages = Language::all();
        $countries = Country::all();

        return view('admin.city.create')->with([
            'languages' => $languages,
            'countries' => $countries,
        ]);
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
        $data = $request->all();
//dd($request->all());
        Validator::make(
            $data,
            [
                'status' => 'sometimes|required|integer|in:' . CITY_ACTIVE,

                'city_name' => ['required','max:190' ,
                    Rule::unique('cities','name')
                        ->where(function ($query) use($data) {
                            $query->where('country_id' , $data['country_id']);
                        })
                ],
                'language' => 'required|array',
                'country_id' => 'required|integer|exists:countries,id'
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
            $city = new Cities();

            $city->name = e(trim($request->city_name));

            if($request->has('status'))
                $city->status = CITY_ACTIVE;
            else
                $city->status = CITY_INACTIVE;

            $city->country_id = $request->country_id;

            // get all languages
            $languages = Language::pluck('id');

            $typedLanguages = $request->language;

            //dd($languages);
            if($city->save()) {
                $cityLanguages = [];
                foreach ($languages as $language) {
                    if (isset($typedLanguages[$language]))
                        $cityLanguages[$language]['name'] = e(trim($typedLanguages[$language]));

                }

                $city->language()->attach($cityLanguages);
                DB::commit();
                return redirect('/admin/cities')->with([
                    'messageSuccess' => __("general.cityAddedSuccessfully")
                ]);
            }else{
                DB::rollBack();
                return redirect()->back()->with([
                    'messageDander' => __("general.errorAddingCity")
                ]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $city = Cities::whereHas('translations')->where('id',$id)->first();


        if($city) {
            $cityLanguages = $city->toArray(function ($item) {
                return [$item['id'] => $item];
            });

            return view('admin.city.edit')->with([
                'city' => $city,
                'cityLanguages' => $cityLanguages,
                'languages' => Language::all(),
                'countries' => Country::all()
            ]);
        }
        else
            return redirect('/admin/countries')->with(['messageDanger' => __('general.cityNotFound') ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        Validator::make(
            $data,
            [
                'city_id' => 'required|integer|exists:cities,id',
                'country_id' => 'required|integer|exists:countries,id',
                'status' => 'sometimes|required|integer|in:' . CITY_ACTIVE,
                'city_name' => ['required','max:190' ,
                    Rule::unique('cities','name')
                        ->ignore($data['city_id'])

                        ->where(function ($query) use($data) {
                            $query->where('country_id' , $data['country_id']);
                        })
                ],
                'language' => 'required|array',
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $city = City::find($data['city_id']);

        if($request->has('status'))
            $city->status = CITY_ACTIVE;
        else
            $city->status = CITY_INACTIVE;

        $city->name = e(trim($request->city_name));

        // get all languages
        $languages = Language::pluck('id');

        $typedLanguages = $request->language;

        //dd($languages);
        if($city->save()) {
            // Delete old relation


            $cityLanguages = [];
            foreach ($languages as $language) {
                if (isset($typedLanguages[$language]))
                    $cityLanguages[$language]['name'] = e(trim($typedLanguages[$language]));

            }

            $city->language()->detach();

            $city->language()->attach($cityLanguages);

            DB::commit();
            return redirect('/admin/cities')->with([
                'messageSuccess' => __("general.cityUpdatedSuccessfully")
            ]);
        }else{
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.errorUpdateCity")
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
