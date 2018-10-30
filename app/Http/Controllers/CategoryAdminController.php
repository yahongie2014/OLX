<?php

namespace App\Http\Controllers;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Language;
use Validator;

class CategoryAdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Services $services)
    {
        $this->category = $services;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $loginType = $request->user()->is_admin;

        if($loginType == ADMIN){
            $categories = $this->category->withTranslation()->get();
        }else{
            $categories = $this->category();
            return response() ->json(['status' => true , 'result' => $categories->toArray()]);
        }
        return view('admin.category.index')
            ->with([
                'categories' => $categories,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.category.create')->with([
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
        Validator::make(
            $data,
            [
                'is_active' => 'sometimes|required|integer|in:' . CATEGORY_ACTIVE,
                'longitude' => 'required',
                'latitudes' => 'required',
                'en_name' => 'required|max:190',
                'ar_name' => 'required|max:190',
                'en_desc' => 'required|max:190',
                'ar_desc' => 'required|max:190',

            ]
        )->validate();


        DB::beginTransaction();
        $category = new $this->category();
        $category->longitude = $request->longitude;
        $category->latitudes = $request->latitudes;
        if($request->has('is_active'))
            $category->is_active = CATEGORY_ACTIVE;
        if($request->hasfile('icon')){
            $services = $request->file(['icon']);
            $name_cover = $services->getClientOriginalName();
            // get the image extension
            $imgExtension = $services->getClientOriginalExtension();
            $path =  Storage::putFileAs('/public/Services', $services, $name_cover);
            $category->icon =  $name_cover;
        }

        if($category->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                    'desc' => $request->input('en_desc'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                    'desc' => $request->input('ar_desc'),
                ],
            ];
            $article = $this->category->findOrFail($category->id);
            $article->update($article_data);

            DB::commit();
            return redirect('/admin/categories')->with([
                'messageSuccess' => __("general.categoryAddedSuccessfully")
            ]);
        }else{
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.errorAddingCategory")
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
        $category = $this->category->whereHas('translations')->where('id',$id)->first();

        if($category){
            return view('admin.category.edit')->with([
                'category' => $category
            ]);

        }else
            return redirect('/admin/categories')->with(['messageDanger' => __('general.categoryNotFound') ]);
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
                'is_active' => 'sometimes|required|integer|in:' . CATEGORY_ACTIVE,
                'longitude' => 'required',
                'latitudes' => 'required',
                'en_name' => 'required|max:190',
                'ar_name' => 'required|max:190',
                'en_desc' => 'required|max:190',
                'ar_desc' => 'required|max:190',
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $category = $this->category->find($data['category_id']);

        if($request->has('is_active'))
            $category->is_active = CATEGORY_ACTIVE;
        else
            $category->is_active = CATEGORY_INACTIVE;

        $category->longitude = $request->longitude;

        $category->latitudes = $request->latitudes;
        if($request->hasfile('icon')){
            $services = $request->file(['icon']);
            $name_cover = $services->getClientOriginalName();
            // get the image extension
            $imgExtension = $services->getClientOriginalExtension();
            $path =  Storage::putFileAs('/public/Services', $services, $name_cover);
            $category->icon =  $name_cover;
        }
        if($category->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                    'desc' => $request->input('en_desc'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                    'desc' => $request->input('en_name'),
                ],
            ];
            $article = $this->category->findOrFail($category->id);
            $article->update($article_data);
            DB::commit();
            return redirect('/admin/categories')->with([
                'messageSuccess' => __("general.categoryUpdatedSuccessfully")
            ]);
        }else{
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.errorUpdateCategory")
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
