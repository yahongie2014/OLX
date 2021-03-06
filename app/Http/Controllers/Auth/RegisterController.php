<?php

namespace App\Http\Controllers\Auth;

use App\Jobs\SendNotification;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/provider';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
        $this->request = $request;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    public function getCoordinate(Request $request)
    {
        $lat = $request->latitude;
        $long =$request->longitude;

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $genrator = rand(200,6000);
        $longitude= 33.6;
        $latitude= 31.2;
        $new = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'city_id' => $data['city_id'],
            'is_vendor' => $data['is_vendor'],
            'longitude' => $longitude,
            'latitudes' => $latitude,
            'language_id' => $data['language_id'],
            'activation_code' => $genrator,
            'password' => bcrypt($data['password']),
        ]);
        $adminNotification = __("general.newUserRegistration");

        dispatch(new SendNotification($adminNotification ,0 , true));
        DB::commit();

        return $new ;
    }
}
