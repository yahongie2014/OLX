<?php

namespace App\Http\Controllers;

use App\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */

    public function signup(Request $request)
    {
       // $generate_number = rand(1544, 1000);
        $generate_number = "1234";
        if ($request->vendor) {
            $request->validate([
                'vendor' => 'required|integer',
                'CompanyNumber' => 'required',
            ]);
        }

        $request->validate([
            'name' => 'required|string',
//            'email' => 'required|string|email|unique:users',
            'phone' => 'required',
            'longitude' => 'required',
            'latitudes' => 'required',
            'password' => 'required|string',
            'vendor' => 'integer',
            'CityId' => 'required|exists:cities,id|integer',
        ]);

//        $phoneV =$this->user->where("phone",$request->phone)->first();
//
//        if($phoneV){
//            return response()->json(['error' => 300, 'message' => 'Your phone number duplicated'])->setStatusCode(400);
//        }

        $user = new $this->user([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'longitude' => $request->longitude,
            'latitudes' => $request->latitudes,
            'city_id' => $request->CityId,
            'activation_code' => $generate_number,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        if ($request->vendor) {
            $request->validate([
                'vendor' => 'required|integer',
                'CompanyNumber' => 'required',
            ]);
            $vendor = $this->user->find($user->id);
            $vendor->is_vendor = $request->vendor;
            $vendor->company_number = $request->CompanyNumber;
            $vendor->update();
        }

        $send = $this->SendSms($request->input('phone'), 'Welcome to My Services, your verification code ' . $generate_number);

        DB::commit();

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();


        return response()->json([
            'message' => 'Successfully created user!',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();
        if ($request->user()->is_vendor == 1) {
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'VendorAccess' => true,
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);

        }

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'VendorAccess' => false,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function reset(Request $request)
    {

        $input = $request->all();


        $query = $request->phone;
        if ($query == null) {
            return response()->json(['error' => 'no phone found'])->setStatusCode(400);
        }
        if (!$query && $query == '')
            return response()->json(['error' => 300, 'message' => 'check your phone number please'])->setStatusCode(400);

        $pass_reset = rand(100000, 999999);//(6);

        $regenerate = Hash::make($pass_reset);

        $user = User::select('*')
            ->where('phone', '=', $query)
            ->update(['password' => $regenerate]);

        if (!$user) {
            return response()->json(['error' => 300, 'message' => 'check your phone number please'])->setStatusCode(400);

        }

        $send = $this->SendSms("$query", 'Welcome to My Services, your new Password is ' . ' : ' . $pass_reset . '' . ' ' . 'Use this to complete your Login');


        return response()->json(['result' => 'Succefuly Resend', 'success' => true]);
    }

    public function confirm(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'phone' => 'required|min:10',
            'activation_code' => 'required|max:5',
        );

        $validator = \Validator::make($input, $rules);

        if ($validator->fails()) {
            $errores = $validator->errors();
            $error_string = '';
            foreach ($errores->messages() as $key => $value) {
                $error_string .= $value[0];
            }
            return response()->json(['error' => 67, 'message' => $error_string])->setStatusCode(400);
        }


        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->phone != $user->phone) {
            return response()->json(['error' => 54, 'message' => 'wrong phone'])->setStatusCode(401);
        }

        if ($request->activation_code == $user->activation_code) {
            $active = User::find($user->id);
            $active->is_verify = 1;
            $active->save();

            return [
                'message' => 'You Are Activaited!'
            ];
        } else {
            return ['error' => 'Wrong Activation code!'];
        }
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        if ($request->input()) {

            $userprofile = $this->user->find($request->user()->id);
            if ($request->UserName) {
                $request->validate([
                    'UserName' => 'required|string',
                ]);
                $userprofile->name = $request->UserName;
            }
            if ($request->Email) {
                $request->validate([
                    'Email' => 'required|string|email|unique:users',
                ]);
                $userprofile->email = $request->Email;
            }
            if ($request->Phone) {
                $userprofile->phone = $request->Phone;
            }elseif($request->Phone == $request->user()->phone){
                $userprofile->phone = $request->Phone;
                $generate_number = rand(1544, 100000);
                $userprofile->activation_code = $generate_number;
                $userprofile->is_verify = 0;
                $send = $this->SendSms($request->Phone, 'your Update verification code ' . $generate_number);
                $request->user()->token()->revoke();
            }
            if ($request->company_number) {
                if ($request->user()->is_vendor == 1) {
                    $request->validate([
                        'CompanyNumber' => 'required',
                    ]);
                }
                $userprofile->company_number = $request->company_number;
            }
            if ($request->City) {
                $userprofile->city_id = $request->City;
            }
            if ($request->password) {
                $userprofile->password = bcrypt($request->Password);
                $request->user()->token()->revoke();
            }
            if ($request->DeactiveAccount) {
                $userprofile->is_blocked = $request->DeactiveAccount;
            }
            if ($request->file('image')) {
                $image = $request->file('image');
                $name_cover = $image->getClientOriginalName();
                $ext_cover = $image->getClientOriginalExtension();
                $avatar = Storage::putFileAs('/public/Avatar', $image, $name_cover);
                $userprofile->image = $name_cover;
            }

            $userprofile->update();

        }

        return response()->json( ["data" => $request->user()->only(["id","name","image","phone","email","longitude","latitudes","company_number"]),"CityLocation" => $request->user()->city->name]);
    }
}