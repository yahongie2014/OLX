<?php

namespace App\Http\Controllers;

use App\User;
use App\UserFireBaseToken;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $orderStatuses;

    public function SendSms($phone ,$message)
    {
        $data = array(
            "Username" => "966593930003",
            "Password" => "75627",
            "Tagname" => "Ratb.li",
            "RecepientNumber" => $phone,
            "VariableList" => "[Name]",
            "ReplacementList" => "Ahmed,9000",
            "Message" => $message,
            "SendDateTime" => 0,
            " EnableDR" => true
        );
        $data_string = json_encode($data);

        $ch = curl_init('http://api.yamamah.com/SendSMS');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        if ($result === FALSE) {
            Log::error('Curl failed: ' . curl_error($ch));
        }
        else{
            //echo $result;
            Log::info($result);
        }

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

        $userTokens = UserFireBaseToken::whereIn('user_id',$usersToNotify)->pluck('firebase_token')->toArray();

        /* WebNotification::create([
             'user_id' => $user,
             'title' => $msgTitle,
             'body' => $msg,

         ]);*/

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
