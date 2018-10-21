<?php

namespace App\Http\Controllers;
use App\Http\Resources\Dashboard\Admin\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use League\Fractal\Manager;
use Illuminate\Support\Facades\Auth;

use App\Language;
define("LANGUAGE_INACTIVE",0);
define("LANGUAGE_ACTIVE",1);
class LanguageController extends Controller
{
    private $fractal;

    /**
     * @var UserTransformer
     */
    private $languageTransformer;

    public function __construct(Language $languageTransformer)
    {
        $this->languageTransformer = $languageTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $loginType = $request->user();

        if($loginType->is_admin == 1)
            $languages = Language::all();
        else{
            $languages = Language::where('status' , 1)->get();
            $languages =  Languages::collection($languages, $this->languageTransformer);

            $languages = $this->fractal->createData($languages); // Transform data
            return response() ->json(['status' => true , 'result' => $languages->toArray()]);
        }
        //dd($languages->toArray());
        return view('admin.language.index')->with([
            'languages' => $languages,
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
        return view('admin.language.create');
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
        if($data['language_symbol'])
            $data['language_symbol'] = strtolower(e($data['language_symbol']));

        Validator::make(
            $data,
            [
                'languageAvailability' => 'sometimes|required|integer|in:' . LANGUAGE_ACTIVE,
                /*'languageDefault' => 'sometimes|required|integer|in:' . DEFAULT_LANGUAGE,*/
                'language_name' => 'required|unique:languages,name|max:190',
                'language_symbol' => 'required|unique:languages,symbol|max:2',
                'language_direction' => 'required|string|in:ltr,rtl',
            ]
        )->validate();
        //dd($request->all());

        DB::beginTransaction();

        $language = new Language();

        $language->name = e(trim($request->language_name));

        $language->symbol = strtolower(e(trim($request->language_symbol)));

        $language->direction = strtolower(e(trim($request->language_direction)));

        if($request->has('languageAvailability'))
            $language->status = $request->languageAvailability;
        else{
            $language->status = LANGUAGE_INACTIVE ;
        }

        $language->default = LANGUAGE_NOT_DEFAULT;

        if($language->save()){


            DB::commit();
            return redirect('/admin/languages')->with(['messageSuccess' => __("general.newCountryAdded")]);

        }else{
            DB::rollBack();
            return redirect()->back()->with(['messageDanger' => __("general.errorAddingCountry")]);
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
        //dd(Language::find($id)->toArray());

        $language = Language::find($id);

        if($language)
            return view('admin.language.edit')->with([
                'language' => $language,
            ]);
        else
            return redirect('/admin/languages')->with(['messageDanger' => __('general.languageNotFound') ]);
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

        Validator::make(
            $request->all(),
            [
                'language_id' => 'required|integer|exists:languages,id',
                'languageAvailability' => 'sometimes|required|integer|in:' . LANGUAGE_ACTIVE,
                /*'languageDefault' => 'sometimes|required|integer|in:' . DEFAULT_LANGUAGE,*/
                'language_name' => ['required','max:190' , Rule::unique('languages','name')->ignore($id)],
                'language_symbol' => ['required','max:2', Rule::unique('languages','symbol')->ignore($id)],
                'language_direction' => 'required|string|in:ltr,rtl',
            ]
        )->validate();

//        dd($request->all());
        DB::beginTransaction();

        $language = Language::find($request->language_id);

        $language->name = e(trim($request->language_name));

        $language->symbol = strtolower(e(trim($request->language_symbol)));

        $language->direction = strtolower(e(trim($request->language_direction)));

        if($request->has('languageAvailability'))
            $language->status = $request->languageAvailability;
        else{
            $language->status = LANGUAGE_INACTIVE ;
        }

        $language->default = LANGUAGE_NOT_DEFAULT;

        if($language->save()){
            DB::commit();
            return redirect('/admin/languages')->with(['messageSuccess' => __("general.LanguageUpdated")]);

        }else{
            DB::rollBack();
            return redirect()->back()->with(['messageDanger' => __("general.errorUpdatingLanguage")]);
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
