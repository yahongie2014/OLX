<?php

namespace App\Http\Controllers;


use App\Models\CountriesTranslation;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use App\Language;

use Validator;

class CountryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countries = Country::whereHas('translations')->get();

        return view('admin.country.index')
            ->with([
                'countries' => $countries,
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

        return view('admin.country.create')->with([
            'languages' => $languages,
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
                'is_active' => 'sometimes|required|integer|in:' . COUNTRY_ACTIVE,
                'code' => 'required|numeric',
                'language' => 'required|array',
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $country = new Country();
        if ($request->has('is_active'))
            $country->is_active = COUNTRY_ACTIVE;
        else
            $country->is_active = COUNTRY_INACTIVE;
        $country->flag = "";
        $country->code = e(trim($request->code));

        if ($country->save()) {
            $typedLanguages = $request->language;
            foreach ($typedLanguages as $language) {
                $lang = new CountriesTranslation();
                $lang->translate('en')->name = $language->name ;
                $lang->translate('ar')->name = $language->name;
                $lang->save();
            }
            DB::commit();
            return redirect('/admin/countries')->with([
                'messageSuccess' => __("general.countryAddedSuccessfully")
            ]);
        }else{
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.errorAddingCountry")
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
        $country = Country::where('id', $id)->first();
        if ($country) {

            return view('admin.country.edit')->with([
                'country' => $country,
                'languages' => Language::all()
            ]);
        } else
            return redirect('/admin/countries')->with(['messageDanger' => __('general.countryNotFound')]);
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
//dd($request->all());
        Validator::make(
            $data,
            [
                'country_id' => 'required|integer|exists:countries,id',
                'status' => 'sometimes|required|integer|in:' . COUNTRY_ACTIVE,
                'country_name' => ['required', 'max:190', Rule::unique('countries', 'name')->ignore($data['country_id'])],
                'currency_name' => ['required', 'max:190', Rule::unique('countries', 'currency_name')->ignore($data['country_id'])],
                'currency_symbol' => ['required', 'max:190', Rule::unique('countries', 'currency_symbol')->ignore($data['country_id'])],
                'code' => ['required', 'numeric', Rule::unique('countries', 'code')->ignore($data['country_id'])],
                'language' => 'required|array',
                'time_zone' => 'required|timezone'
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $country = Country::find($data['country_id']);

        if ($request->has('status'))
            $country->status = COUNTRY_ACTIVE;
        else
            $country->status = COUNTRY_INACTIVE;

        $country->name = e(trim($request->country_name));

        $country->currency_name = e(trim($request->currency_name));

        $country->currency_symbol = e(strtoupper(trim($request->currency_symbol)));

        $country->code = e(trim($request->code));

        $country->flag = "";

        $country->phone = 8;

        $country->time_zone = e(trim($request->time_zone));
        // get all languages
        $languages = Language::pluck('id');

        $typedLanguages = $request->language;

        //dd($languages);
        if ($country->save()) {
            // Delete old relation
            $countryLanguages = [];
            foreach ($languages as $language) {
                if (isset($typedLanguages[$language]))
                    $countryLanguages[$language]['name'] = e(trim($typedLanguages[$language]));

            }

            $country->language()->detach();

            $country->language()->attach($countryLanguages);

            DB::commit();
            return redirect('/admin/countries')->with([
                'messageSuccess' => __("general.countryUpdatedSuccessfully")
            ]);
        } else {
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.errorUpdateCountry")
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
