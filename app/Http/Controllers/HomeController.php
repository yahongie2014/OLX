<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Language;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Transformers\CityTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fractal;

    /**
     * @var UserTransformer
     */
    private $cityTransformer;

    public function __construct(Manager $fractal, CityTransformer $cityTransformer)
    {
        $this->fractal = $fractal;
        $this->cityTransformer = $cityTransformer;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function setLanguage($language_id)
    {


        $validator = \Validator::make(
            ['language_id' => $language_id],
            [
                'language_id' => 'required|integer|exists:languages,id',

            ]
        )->validate();

        // Get selected language
        $language = Language::find($language_id);

        // save user language in the session
        Session::put('userLanguage', $language);
        Session::put('userLanguageName', $language->name);

        // update the authenticated user language
        $user = Auth::user();
        $user->language_id = $language_id;

        $user->save();
        return redirect()->back();
    }

    public function passwordReset(Request $request)
    {
        \Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:users,email',
            ]
        )->validate();

        $newPassword = rand(100000, 999999);

        $user = User::where('email', $request->email)->first();

        $user->password = bcrypt($newPassword);

        if ($user->save())
            dispatch($this->SendSms($user->phone, "New Password : " . "\n" . $newPassword));

        return redirect('login');
    }

    public function authSocket()
    {
        return response()->json(['success' => true, 'id' => Auth::user()->id]);
    }

    public function cities(Request $request)
    {
        //
        $loginType = session()->get('login_type');

        if (Auth::user())
            $language_id = Auth::user()->language_id;
        else
            $language_id = Language::where('default', DEFAULT_LANGUAGE)->first(['id'])->id;

        $cities = Cities::with("country")->get();

        if ($request->has('country_id'))
            $cities = $cities->where('country_id', $request->country_id);

        if (!($loginType == ADMIN)) {
            if (!$request->has('country_id'))
                $cities = $cities->where('country_id', Auth::user()->country_id);

            $cities = $cities->where('status', CITY_ACTIVE);
        }

        $cities = $cities->get();

        if (Request()->expectsJson()) {
            $cities = new Collection($cities, $this->cityTransformer);
            $cities = $this->fractal->createData($cities); // Transform data

            return response()->json(['status' => true, 'result' => $cities->toArray()]);
        }

        return view('admin.city.index')
            ->with([
                'cities' => $cities,
            ]);
    }

    public function admin()
    {
        return view('admin.index')
            ->with([
                'orderStatuses' => $this->orderStatuses,
                'userRoute' => '/admin',
            ]);
    }

    public function provider()
    {
        return view('provider.index')->with([
            'orderStatuses' => $this->orderStatuses,
            'userRoute' => '/provider',
        ]);
    }


    public function city(Request $request)
    {
        $cities = Cities::with('country');

        if($request->has('country_id'))
            $cities = $cities->where('country_id',$request->country_id);

        $cities = $cities->where('status',1);

        $cities = $cities->get();

        if(Request()->expectsJson()){
            $cities = new Collection($cities, $this->cityTransformer);
            $cities = $this->fractal->createData($cities); // Transform data

            return response() ->json(['status' => true , 'result' => $cities->toArray() ]);
        }

        return view('admin.city.index')
            ->with([
                'cities' => $cities,
            ]);

    }


}
