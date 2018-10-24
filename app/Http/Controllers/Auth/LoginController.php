<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        Session::put('login_type',$request->login_type);

        switch ($request->login_type){
            case 1:
                $this->redirectTo = '/admin';
                break;
            case 2:
                $this->redirectTo = '/provider';
                break;
            default:
                $this->redirectTo = '/provider';
                break;
        }



        // Get System active Languages
        $languages = Language::where('status',1)->get();

        // Save system languages in session for farther select
        Session::put('systemLanguages',$languages);

        // get user language symbol
        $userLanguage = Language::find(Auth::user()->language_id);

        // save user language in the session
        Session::put('userLanguage',$userLanguage);

        Session::put('userLanguageName',$userLanguage->name);


        // Save system languages in session for farther select
        Session::put('systemLanguages',$languages);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect($this->redirectPath());//->intended($this->redirectPath());
    }

}
