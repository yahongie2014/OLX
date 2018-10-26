<?php

namespace App\Http\Controllers;


use App\Cities;
use App\Http\Resources\CityTransformer;
use App\Models\CitiessTranslation;
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

        if (Auth::user())
            $language_id = Auth::user()->language_id;
        else
            $language_id = Language::where('default', DEFAULT_LANGUAGE)->first(['id'])->id;

        $cities = Cities::with('country');


        if ($request->has('country_id'))
            $cities = $cities->where('country_id', $request->country_id);


        $cities = $cities->withTranslation()->get();

        if (Request()->expectsJson()) {
            $cities = CityTransformer::collection($this->cities->with("country")->where('country_id', $request->country_id)->get());

            return response()->json(['status' => true, 'result' => $cities->withTranslation()->toArray()]);
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
        $countries = Country::withTranslation()->get();

        return view('admin.city.create')->with([
            'languages' => $languages,
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        Validator::make(
            $data,
            [
                'is_active' => 'sometimes|required|integer|in:' . CITY_ACTIVE,
                'country_id' => 'required|integer|exists:countries,id',
                'en_name' => 'required',
                'ar_name' => 'required',
                'longitude' => 'required',
                'latitudes' => 'required'
            ]
        )->validate();

        DB::beginTransaction();
        $city = new Cities();
        if ($request->has('is_active'))
            $city->is_active = CITY_ACTIVE;
        else
            $city->is_active = CITY_INACTIVE;

        $city->country_id = $request->country_id;
        $city->longitude = $request->longitude;
        $city->latitudes = $request->latitudes;
        if ($city->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                ],
            ];
            $article = Cities::findOrFail($city->id);
            $article->update($article_data);

            DB::commit();
            return redirect('/admin/cities')->with([
                'messageSuccess' => __("general.cityAddedSuccessfully")
            ]);
        } else {
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.errorAddingCity")
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $city = Cities::whereHas('translations')->where('id', $id)->first();


        if ($city) {
            $cityLanguages = $city->toArray(function ($item) {
                return [$item['id'] => $item];
            });

            return view('admin.city.edit')->with([
                'city' => $city,
                'cityLanguages' => $cityLanguages,
                'languages' => Language::all(),
                'countries' => Country::all()
            ]);
        } else
            return redirect('/admin/countries')->with(['messageDanger' => __('general.cityNotFound')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        Validator::make(
            $data,
            [
                'is_active' => 'sometimes|required|integer|in:' . CITY_ACTIVE,
                'country_id' => 'required|integer|exists:countries,id',
                'en_name' => 'required|max:190',
                'ar_name' => 'required|max:190',
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $city = Cities::find($data['city_id']);
        if ($request->has('is_active'))
            $city->is_active = CITY_ACTIVE;
        else
            $city->is_active = CITY_INACTIVE;
        $city->longitude = $request->longitude;
        $city->is_active = $request->is_active;
        $city->latitudes = $request->latitudes;

        if ($city->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                ],
            ];
            $article = Cities::findOrFail($city->id);
            $article->update($article_data);

            DB::commit();
            return redirect('/admin/cities')->with([
                'messageSuccess' => __("general.cityUpdatedSuccessfully")
            ]);
        } else {
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.errorUpdateCity")
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
