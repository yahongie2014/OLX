<?php

namespace App\Http\Controllers;
use App\Cities;
use App\Language;
use App\Models\Country;
use App\UserFireBaseToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// Models
use Validator;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $validator = Validator::make(
            ['user_id' => $id],
            [
                'user_id' => 'required|exists:users,id|integer',
            ]
        )->validate();

        $outputData = [];

        $user = User::find($id);

        // get user country code

        // if he is the same user so he can update if not he only can show this user
        $canUpdate = Auth::user()->id == $id ? true : false ;

        // Get all Countries available in the system - required for update
        $list = Cities::where("id",Auth::user()->city_id)->get();
      //  dd($list[0]["country_id"]);

        $countries = $canUpdate ? Country::all() : Country::where('id' , $list[0]["country_id"])->get();

        // Get user country cities
        $cities = $canUpdate ? Cities::where('country_id', $countries[0]->id)->get() : Cities::where('id' , $user->city_id)->get();





        // Get total orders by day year Month
        $now = Carbon::now("Africa/Cairo");

        $languages = $canUpdate ? Language::all() : Language::where('id' , $user->language_id)->get();

        // If the profile owner generate an update link
        $updateLink = $canUpdate ? Route::current()->action['prefix'] . "/profile/" . Auth::user()->id : '';

        // set the view upon called route
        $outputView = ltrim(Route::current()->action['prefix'],'/') . ".profile.show";

        $outputData['user'] = $user;
        $outputData['countries'] = $countries;
        $outputData['languages'] = $languages;
        $outputData['canUpdate'] = $canUpdate;
        $outputData['updateLink'] = $updateLink;
        $outputData['cities'] = $cities;

        //dd($outputData);

        return view($outputView)
            ->with( $outputData );    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

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
                'user_id' => 'required|exists:users,id|integer|in:' . Auth::user()->id ,
                'userName' => 'sometimes|required|string|max:190',
                /*'email' => 'sometimes|required|email|max:190|unique:users,email,' . $request->user_id . ',id',*/
                'phone' => ['sometimes' , 'required' , Rule::unique('users','phone')->ignore($id)] ,
                'language_id' => 'sometimes|required|exists:languages,id|integer',
                'country_id' => 'sometimes|required|exists:countries,id|integer',
                'city_id' => ['sometimes' , 'required' , 'integer' ,Rule::exists('cities','id')->where(function ($query) use($data) {
                    $query->where('country_id', $data['country_id']);
                }) ],
                'address' => 'sometimes|required|string',
                'profileImage' => 'sometimes|required|image|max:2048',
                'coverImage' => 'sometimes|required|image|max:2048|dimensions:width=1245,height=296'
            ]
        )->validate();

        // Get that user data
        $user = Auth::user();

        if($request->has('userName'))
            $user->name = e(trim($request->userName));

        if($request->has('email'))
            $user->email = e(trim($request->email));

        if($request->has('phone'))
            $user->phone = e(trim($data['phone']));

        if($request->has('language_id')){
            $user->language_id = $request->language_id;

            // Get selected language
            $language = Language::find($request->language_id);

            // save user language in the session
            Session::put('userLanguage',$language);
        }


        if($request->has('city_id'))
            $user->city_id = $request->city_id;

        if($request->hasfile('profileImage')){

            $userImage = $request->file(['profileImage']);
            $name_cover = $userImage->getClientOriginalName();
            // get the image extension
            $imgExtension = $userImage->getClientOriginalExtension();
            //profile Images uploading path
            $path =  Storage::putFileAs('/public/Avatar', $userImage, $name_cover);

            $user->image =  $name_cover;
        }

        if($request->hasfile('coverImage')){

            $userImage = $request->file(['coverImage']);

            // get the image extension
            $imgExtension = $userImage->getClientOriginalExtension();

            //profile Images uploading path
            $path = 'uploads/profile/';

            // assign name to the image
            $fileName = uniqid() . '.' . $imgExtension ;

            // move the image to profile folder
            $userImage->move($path , $fileName);

            $user->cover_image = $path . $fileName;
        }

        if($user->save())
            return redirect()->back()->with(['messageSuccess' => __('general.User profile updated successfully')]);
        else
            return redirect()->back()->with(['messageDanger' => __('general.User profile is not updated try again later')]);
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

    public function updateUserFireBaseToken(Request $request){
        Validator::make(
            $request->all(),
            [
                'firebase_token' => 'required|string',
            ]
        )->validate();

        // Get user previous token in the same type if existed
        $user = Auth::user();
        $userToken = $user->firebase_tokens()->where('login_type',1)->first();

        if(!$userToken){
            $userToken = new UserFireBaseToken();
            $userToken->user_id = $user->id;
        }
        $userToken->firebase_token = $request->firebase_token;
        $userToken->login_type = 1;

        if($userToken->save()){
            return response()->json(['status' => true], 200);
        }else{
            return response()->json(['status' => false], 500);
        }
    }

    public function apiLogin(Request $request){
        //dd("k");

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token =  $user->createToken('Delivery')->accessToken;
            return response()->json(['success' => true , 'token' => $token], 200);
        }
        else{
            return response()->json(['success' => false ,'error'=>'Unauthorised'], 401);
        }
    }

    public function changePassword(Request $request){
        Validator::make(
            $request->all(),
            [
                'oldPassword' => 'required|string|min:6',
                'password' => 'required|string|min:6|confirmed',
            ]
        )->validate();

        $user = Auth::user();

        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = bcrypt($request->password);

            if($user->save()){
                return redirect()->back()->with(['messageSuccess' => __('general.User password changed successfully')]);
            }else{
                return redirect()->back()->with(['messageDanger' => __('general.User password could not be changed')]);
            }
        }else{
            return redirect()->back()->with(['messageDanger' => __('general.Wrong old password')]);
        }
    }
}
