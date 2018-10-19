<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookmarkForm;
use App\Http\Resources\FavouriteApi;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    public function __construct(Bookmark $book)
    {
        App::setLocale("ar");

        $this->book = $book;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return FavouriteApi::collection($this->book->with("users")->where("user_id",$request->user()->id)->paginate());
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
    public function store(BookmarkForm $request)
    {
        if ($request->user()->id != $request->user_id) {
            return response()->json(['error' => 'You cant create any bookmark'], 403);
        }

        $bookmark = new $this->book($request->all());
         DB::commit();
        return new FavouriteApi($bookmark);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
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
        if($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        }else{
            $only = $this->book->findOrFail($id);

            if ($request->user()->id !== $only->user_id) {
                return response()->json(['error' => 'You can only show your Products.'], 403);
            }

            return new FavouriteApi($only);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookmark $bookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
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

        if($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        }else{
            $soft = $this->book->findOrFail($id);
            if ($request->user()->id != $soft->user_id) {
                return response()->json(['error' => 'You can only delete your Bookmark Service.'], 403);
            }
            $soft->delete();

            return response()->json(["message" => "Your Bookmark Was Deleted"]);
        }
    }
}
