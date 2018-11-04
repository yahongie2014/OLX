<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsForm;
use App\Http\Resources\AdsProductApi;
use App\Http\Resources\ProductsApi;
use App\Models\AdsProducts;
use App\Models\Products;
use App\Models\ProductsImages;
use App\Models\ProductsTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct(Products $products, ProductsImages $image, ProductsTranslation $trnslator,AdsProducts $ads)
    {
        // App::setLocale(env("LOCALE"));
        $this->middleware('auth:api');
        $this->products = $products;
        $this->images = $image;
        $this->trnslator = $trnslator;
        $this->ads = $ads;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ProductsApi::collection($this->products->with("users")->where("user_id", $request->user()->id)->whereNull('deleted_at')->paginate());
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsForm $request)
    {
        if ($request->locale_ar) {
            $rules = array(
                'name_ar' => 'required|string|max:50',
                'desc_ar' => 'required|string|max:255',
                'locale_ar' => 'required',
            );
            $messages = array(
                'name_ar.required' => 'Arabic Name Must be Required',
                'desc_ar.required' => 'Arabic Descereption Must be Required',
            );
            $validator = \Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()])->setStatusCode(422);
            }
        }

        $product = new $this->products($request->all());
        $file_cover = $request->file('cover_image');
        $name_cover = $file_cover->getClientOriginalName();
        $ext_cover = $file_cover->getClientOriginalExtension();
        $cover = Storage::putFileAs('/public/Products', $file_cover, $name_cover);
        if ($cover) {
            $product::find($product->id);
            $product->cover_image = $name_cover;
            $product->user_id = $request->user()->id;
            $product->update();
        }
        if ($product->save() && $request->Images) {
            $file = $request->file('Images');
            foreach ($file as $files) {
                $name_image = $files->getClientOriginalName();
                $ext = $files->getClientOriginalExtension();
                $name = Storage::putFileAs('/public/FeaturesProduct', $files, $name_image);
                $img = new $this->images($request->all());
                $img->products_id = $product->id;
                $img->path = $name_image;
                $img->save();

            }
            
            if ($request->locale_ar) {
                $pro_trnslator = new $this->trnslator();
                $pro_trnslator->name = $request->name_ar;
                $pro_trnslator->desc = $request->desc_ar;
                $pro_trnslator->price = $product->price;
                $pro_trnslator->locale = $request->locale_ar;
                $pro_trnslator->products_id = $product->id;
                $pro_trnslator->save();
            }

        }
        DB::commit();

        return new ProductsApi($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $only = $this->products->findOrFail($id);

            if ($request->user()->id !== $only->user_id) {
                return response()->json(['error' => 'You can only show your Products.'], 403);
            }

            return new ProductsApi($only);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
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

        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $soft = $this->products->findOrFail($id);

            if ($request->user()->id !== $soft->user_id) {
                return response()->json(['error' => 'You can only delete your Product.'], 403);
            }
            $mage_path = $this->images->where("products_id",$id)->get();
            foreach ($mage_path as $items){
                $single = $this->images->findOrFail($items->id);
                $single->delete();
            }
            $ads = $this->ads->where("product_id",$id)->get();
            foreach ($ads as $ad){
                $items = $this->ads->findOrFail($ad->id);
                $items->delete();
            }
            $soft->delete();
            DB::commit();
            return response()->json(["message" => "Product $soft->name was Deleted"]);
        }

    }

}
