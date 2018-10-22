<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsForm;
use App\Http\Resources\ProductsApi;
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
    public function __construct(Products $products, ProductsImages $image, ProductsTranslation $trnslator)
    {
        // App::setLocale(env("LOCALE"));
        $this->middleware('auth:api');
        $this->products = $products;
        $this->images = $image;
        $this->trnslator = $trnslator;
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
        if ($product->save()) {
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

            DB::commit();

        }

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
        $data = $request->all();

        if ($request->global_locale_ar) {
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
        if ($request->global_locale) {
            $rules = array(
                'name' => 'required|string|max:50',
                'desc' => 'required|string|max:255',
                'price' => 'required',
                'is_active' => 'required|integer',
            );
            $messages = array(
                'name.required' => 'Name Must be Required',
                'desc.required' => 'Descereption Must be Required',
                'price.required' => 'Descereption Must be Required',
                'is_active.required' => 'Status Must be Required',
            );
            $validator = \Validator::make(Input::all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()])->setStatusCode(422);
            }
        }


        DB::beginTransaction();
        $update = $this->products->find($id);
        if ($request->has('name')) {
            $update->name = $request->name;
        }
        if ($request->has('desc')) {
            $update->desc = $request->desc;
        }
        if ($request->has('price')) {
            $update->price = $request->price;
        }
        if ($request->has('locale')) {
            $update->locale = $request->global_locale;
        }
        if ($request->has('name_ar')) {
            $update->name = $request->name_ar;
        }
        if ($request->has('desc_ar')) {
            $update->desc = $request->desc_ar;
        }
        if ($request->has('price_ar')) {
            $update->price = $request->price_ar;
        }
        if ($request->has('locale')) {
            $update->locale = $request->global_locale_ar;
        }
        if ($request->has('is_active')) {
            $update->is_active = $request->is_active;
        }
        if ($request->has('cover_image')) {
            $file_cover = $request->file('cover_image');
            $name_cover = $file_cover->getClientOriginalName();
            $ext_cover = $file_cover->getClientOriginalExtension();
            $cover = Storage::putFileAs('/public/Products', $file_cover, $name_cover);
            $update->cover_image = $name_cover;
        }
        if ($update->update()) {
            if ($request->has('Images')) {
                $file = $request->has('Images');
                foreach ($file as $files) {
                    $idPRo = $this->images->find("product_id",$update->id);
                    foreach ($idPRo as $id => $value) {
                        $productImage = $request->path;
                        if ($productImage) {
                            $delete_old = Storage::delete('/public/FeaturesProduct' . $productImage);
                            $update->destroy($id);
                        }
                    }
                    $name_image = $files->getClientOriginalName();
                    $ext = $files->getClientOriginalExtension();
                    $name = Storage::putFileAs('/public/FeaturesProduct', $files, $name_image);
                    $img = new $this->images($request->all());
                    $img->products_id = $update->id;
                    $img->path = $name_image;
                    $img->update();
                }
            }

        }
        DB::commit();


        return new ProductsApi($update);

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
            $soft->delete();

            return response()->json(["message" => "Product $soft->name was Deleted"]);
        }

    }
}
