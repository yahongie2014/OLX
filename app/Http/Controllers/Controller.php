<?php

namespace App\Http\Controllers;
use App\Notification;
use App\User;
use App\UserFireBaseToken;
use Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Curl;
define("GOOGLE_API_KEY", "AAAAyK5PY7U:APA91bHOd0FzCjeYP3ls4bUjBC9nVe1M3MNbRpvv2KW83UgOPp2Y6GjdrtJOIDJStDCFOVHkcZ85RT-UvQMePYE8yt_yMWg15C2Vf4dDsNBCDttXankdQ9FplZW9XEQTH840pq6YXZ6a");

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $orderStatuses;

    public function __construct()
    {
        App::setLocale(Session::get('userLanguage.symbol'));

    }

    public function SendSms($phone ,$message)
    {
        $curl = new Curl();

        $username = "al3omdh25";		// The user name of gateway
        $password = "Emad2525"; 			// the password of gateway
        $sender = "At Time";
        $url = "http://www.jawalbsms.ws/api.php/sendsms?user=$username&pass=$password&to=$phone&message=$message&sender=$sender";
        $urlDiv = explode("?", $url);
        $result = $curl->_simple_call("post", $urlDiv[0], $urlDiv[1], array("TIMEOUT" => 3));

        return true;
    }

    public function sendNotificationsToUser($msg,$user = 0 ,$withAdmin = true , $clickAction = ""){
        $url = "https://fcm.googleapis.com/fcm/send";

        $usersToNotify = [];

        if($user != 0){
            $usersToNotify[] = $user;
        }
        // Notify Admins if wanted
        if($withAdmin){
            $admins = User::where('is_admin' , 1 )->pluck('id')->toArray();
            $usersToNotify = array_merge($usersToNotify,$admins);
            //dd($usersToNotify);
        }

        $userTokens = User::whereIn('id',$usersToNotify)->pluck('firebase_token')->toArray();

        $notify = new Notification();
        $notify->user_id = $user;
        $notify->message = $msg;
        $notify->is_read = 0;
        $notify->status = 1;
        $notify->link = $clickAction;
        $notify->save();


        //dd($userTokens);
        if(count($userTokens) > 0) {
            $fields = array(
                'registration_ids' => $userTokens,
                'notification' => [
                    "title" => env("APP_NAME","At Time"),
                    "body" => $msg,
                    "icon" => asset('dist/img/logo.png'),
                    "click_action" => url($clickAction)
                ]
            );

            $headers = array(
                'Authorization: key=' . GOOGLE_API_KEY,
                'Content-Type: application/json'
            );
            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            //dd($result);
            if ($result === FALSE) {
                //die('Curl failed: ' . curl_error($ch));
                Log::error('Curl failed: ' . curl_error($ch));
            } else {
                //echo $result;
                Log::info($result);
            }

            // Close connection
            curl_close($ch);
        }
        return true;
    }


}
