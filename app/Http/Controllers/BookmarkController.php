<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookmarkForm;
use App\Http\Resources\AdsUerApi;
use App\Http\Resources\FavouriteApi;
use App\Models\Advertising;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    public function __construct(Bookmark $book,Advertising $ads)
    {
        $this->middleware('auth:api');
        $this->book = $book;
        $this->ads = $ads;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $book = $this->book->select("*")->where("user_id",$request->user()->id)->get();

        return AdsUerApi::collection($this->ads->with("users")->where("id",$book[0]['ads_id'])->whereNull('deleted_at')->paginate());
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
        $count = $this->book->where('ads_id', '=', $request->ads_id)->where('user_id', '=', $request->user()->id)->count();

        if ($count) {
            return response()->json(["message" => "The given data was invalid", 'errors' => 'you Already Favourite That Service'])->setStatusCode(400);
        }

        $bookmark = new $this->book($request->all());
        $bookmark->user_id = $request->user()->id;
        $bookmark->save();
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
                'id' => 'required|exists:bookmarks,id|integer',
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
                'id' => 'required|exists:bookmarks,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );

        if($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        }else{
            $soft = $this->book->findOrFail($id);
            $soft->delete();

            return response()->json(["message" => "Your Bookmark Was Deleted"]);
        }
    }
}
