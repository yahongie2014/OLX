<?php

namespace App\Http\Controllers;


use App\Models\CountriesTranslation;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $countries = Country::withTranslation()->get();

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
                'en_name' => 'required|string',
                'ar_name' => 'required|string',
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $country = new Country();
        if($request->has('is_active'))
            $country->is_active = COUNTRY_ACTIVE;
        else
            $country->is_active = COUNTRY_INACTIVE;
        $country->code = e(trim($request->code));
        if($request->hasfile('flag')){
            $flag = $request->file(['flag']);
            $name_cover = $flag->getClientOriginalName();
            // get the image extension
            $imgExtension = $flag->getClientOriginalExtension();
            //profile Images uploading path
            $path =  Storage::putFileAs('/public/Flag', $flag, $name_cover);
            $country->flag =  $name_cover;
        }
        if ($country->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                ],
            ];
            $article = Country::findOrFail($country->id);
            $article->update($article_data);
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
                'is_active' => 'sometimes|required|integer',
                'flag' => 'sometimes|required',
                'code' => ['required', 'numeric', Rule::unique('countries', 'code')->ignore($data['country_id'])],
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $country = Country::find($data['country_id']);
        $country->is_active = $request->is_active;
        $country->code = e(trim($request->code));
        if($request->hasfile('flag')){
            $flag = $request->file(['flag']);
            $name_cover = $flag->getClientOriginalName();
            // get the image extension
            $imgExtension = $flag->getClientOriginalExtension();
            //profile Images uploading path
            $path =  Storage::putFileAs('/public/Flag', $flag, $name_cover);
            $country->flag =  $name_cover;
        }
        if ($country->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                ],
            ];
            $article = Country::findOrFail($country->id);
            $article->update($article_data);

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
