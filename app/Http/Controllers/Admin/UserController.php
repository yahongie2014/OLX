<?php

namespace App\Http\Controllers;
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

        $user = User::with('provider','provider.services_discounts','delivery')->find($id);

        // get user country code
        $userCountryCode = Country::where('id' ,$user->country_id)->first(['code']);

        // parse user phone without country code
        $user->phone = substr($user->phone,intval(strlen($userCountryCode->code)));

        // if he is the same user so he can update if not he only can show this user
        $canUpdate = Auth::user()->id == $id ? true : false ;

        // Get all Countries available in the system - required for update
        $countries = $canUpdate ? $this->localizeSystemActiveCountries(Country::all()) : $this->localizeSystemActiveCountries(Country::where('id' , $user->country_id)->get());

        // Get user country cities
        $cities = $canUpdate ? $this->localizeSystemActiveCities(City::where('country_id',$user->country_id)->get()) : $this->localizeSystemActiveCities(City::where('id' , $user->city_id)->get());


        // Get total orders by day year Month
        $now = Carbon::now($user->country->time_zone);

        if($user->provider){
            // Get all Services
            $services = $this->localizeServiceTypes(ServiceType::all());

            // Get services discounts for that user
            $serviceDiscount = $user->provider->services_discounts->mapWithKeys(function ($item) {
                return [$item['id'] => $item['pivot']['discount']];
            });

            // Get all Payment Types
            $paymentTypes = $this->localizePaymentTypes(PaymentType::all());

            // Get payment types discounts for that user
            $paymentTypesDiscount = $user->provider->payment_type_discounts->mapWithKeys(function ($item) {
                return [$item['id'] => $item['pivot']['discount']];
            });


            // Get provider orders statistics

            // Provider total orders
            $user->provider->allOrders = Order::where('provider_id',$user->provider->id)->count();

            // Provider Month orders
            $user->provider->monthOrders = Order::where('provider_id',$user->provider->id)->where(DB::raw("MONTH(created_at)") , $now->month)->count();

            // Provider Day orders
            $user->provider->dayOrders = Order::where('provider_id',$user->provider->id)->where(DB::raw("DATE(created_at)") , $now->format("Y-m-d"))->count();

            // Get providers loading points
            $user->provider->loadings = ProviderLoading::where('provider_id',$user->provider->id)->get();


            //dd($user->provider->loadings->toArray());
            //-------------------------
            $outputData['services'] = $services;
            $outputData['paymentTypes'] = $paymentTypes;
            $outputData['serviceDiscount'] = $serviceDiscount;
            $outputData['paymentTypesDiscount'] = $paymentTypesDiscount;

        }

        if($user->delivery){
            // Delivery total orders
            $user->delivery->allOrders = Order::where('delivery_id',$user->delivery->id)->count();

            // Delivery Month orders
            $user->delivery->monthOrders = Order::where('delivery_id',$user->delivery->id)->where(DB::raw("MONTH(created_at)") , $now->month)->count();

            // Delivery Day orders
            $user->delivery->dayOrders = Order::where('delivery_id',$user->delivery->id)->where(DB::raw("DATE(created_at)") , $now->format("Y-m-d"))->count();

            // Get user system car types
            $carTypes = $canUpdate ? $this->localizeSystemActiveCarTypes(CarType::where('status',CAR_TYPE_ACTIVE)->get()) : $this->localizeSystemActiveCarTypes(CarType::where('id' , $user->delivery->car_type_id)->get());

            $outputData['carTypes'] = $carTypes;
            //-------------------------
        }
        //dd($user->toArray());
        // Get all Languages available in the system - required for update
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
