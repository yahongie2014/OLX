<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsForm;
use App\Models\Products;
use App\Models\ProductsTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsVendorController extends Controller
{
    public function __construct(Products $products, ProductsTranslation $trans)
    {
        $this->product = $products;
        $this->trans = $trans;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->product->with("images")->where("user_id", Auth::user()->id)->get();

        return view("provider.products.index")->with("list", $list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("provider.products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        \Validator::make(
            $data,
            [
                'is_active' => 'sometimes|required|integer',
                'cover_image' => 'required',
                'en_name' => 'required|max:190',
                'ar_name' => 'required|max:190',
                'en_desc' => 'required|max:190',
                'ar_desc' => 'required|max:190',
                'en_price' => 'required|integer',
                'ar_price' => 'required|integer',

            ]
        )->validate();
        DB::beginTransaction();
        $new = new $this->product();
        $new->is_active = $request->is_active;
        $new->user_id = Auth::user()->id;
        if($request->hasfile('cover_image')){
            $new = $request->file('cover_image');
            $name_cover = $new->getClientOriginalName();
            $imgExtension = $new->getClientOriginalExtension();
            $path =  Storage::putFileAs('/public/Products', $new, $name_cover);
            $new->icon =  $name_cover;
        }
        if ($new->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                    'desc' => $request->input('en_desc'),
                    'price' => $request->input('en_price'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                    'desc' => $request->input('ar_name'),
                    'price' => $request->input('ar_price'),
                ],
            ];
            $article = $this->product->findOrFail($new->id);
            $article->update($article_data);

        }
        Db::commit();
        if ($article) {
            return redirect()->back()->with(["messageSuccess" => __("general.AddProduct")]);
        } else {
            DB::rollBack();
            return redirect()->back()->with(["messageDanger" => __("general.FailAddProduct")]);

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pro = $this->product->findOrFail($id);

        return view("provider.products.edit")->with("pro", $pro);

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
