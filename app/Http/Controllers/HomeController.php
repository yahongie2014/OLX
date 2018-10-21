<?php

namespace App\Http\Controllers;

use App\Language;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

    public function passwordReset(Request $request){
        \Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:users,email',
            ]
        )->validate();

        $newPassword = rand(100000,999999);

        $user = User::where('email',$request->email)->first();

        $user->password = bcrypt($newPassword);

        if($user->save())
            dispatch( $this->SendSms($user->phone , "New Password : " . "\n" . $newPassword));

        return redirect('login');
    }

    public function authSocket()
    {
        return response()->json(['success' => true, 'id' => Auth::user()->id]);
    }

}
