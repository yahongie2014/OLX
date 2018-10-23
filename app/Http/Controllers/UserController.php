<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session ;
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
    public function show($id)
    {
        //
        $validator = Validator::make(
            ['user_id' => $id],
            [
                'user_id' => 'required|exists:users,id|integer',
            ]
        )->validate();

        $outputData = [];

        $user = User::with('city')->find($id);

       // var_dump($user);

        // if he is the same user so he can update if not he only can show this user
        $canUpdate = Auth::user()->id == $id ? true : false ;

        // Get total orders by day year Month
        $now = Carbon::now($user->city->time_zone);


        // If the profile owner generate an update link
        $updateLink = $canUpdate ? Route::current()->action['prefix'] . "/profile/" . Auth::user()->id : '';

        // set the view upon called route
        $outputView = ltrim(Route::current()->action['prefix'],'/') . ".profile.show";

        $outputData['user'] = $user;
        $outputData['canUpdate'] = $canUpdate;
        $outputData['updateLink'] = $updateLink;

        //dd($outputData);

        return view($outputView)
            ->with( $outputData );
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
        //dd($data);
        if($data['country_id'] && $data['phone']) {
            $data['phone'] = $this->getPhoneWithCode(ltrim($data['phone'],"0"),$data['country_id']);
        }

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


        if($request->has('country_id'))
            $user->country_id = $request->country_id;

        if($request->has('city_id'))
            $user->city_id = $request->city_id;

        if($request->has('address'))
            $user->address = e($request->address);

        if($request->hasfile('profileImage')){

            $userImage = $request->file(['profileImage']);

            // get the image extension
            $imgExtension = $userImage->getClientOriginalExtension();

            //profile Images uploading path
            $path = 'uploads/profile/';

            // assign name to the image
            $fileName = uniqid() . '.' . $imgExtension ;

            // move the image to profile folder
            $userImage->move($path , $fileName);

            $user->image = $path . $fileName;
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
                'login_type' => 'required|integer|in:'. WEB .',' . ANDROID.','.IOS ,

            ]
        )->validate();

        // Get user previous token in the same type if existed
        $user = Auth::user();
        $userToken = $user->firebase_tokens()->where('login_type',$request->login_type)->first();

        if(!$userToken){
            $userToken = new UserFireBaseToken();
            $userToken->user_id = $user->id;
        }

        $userToken->firebase_token = $request->firebase_token;
        $userToken->login_type = $request->login_type;


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
