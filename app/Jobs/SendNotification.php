<?php

namespace App\Jobs;

use App\User;
use App\UserFireBaseToken;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Log;

//define("GOOGLE_API_KEY", "AAAAbcImFjE:APA91bFdizGK_jsQfjDSxFPwOLHBUkMAsys-78YuZr7B2L1JRgzy2ICu0SRNsct478ohlrVDRuItfYtHUxpgtraJy1EYQGq2j0MdBSV43JOStfOjvnpYaGTqz20ZiUe5EyghN5aDr4vv");
class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $msg , $user , $withAdmin , $clickAction;

    /**
     * Create a new job instance.
     * @param $msg
     * @param $user
     * @param $withAdmin
     * @param $clickAction
     *
     */
    public function __construct($msg,$user = 0 ,$withAdmin = true , $clickAction = "")
    {
        //
        $this->msg = $msg;
        $this->user = $user;
        $this->withAdmin = $withAdmin;
        $this->clickAction = $clickAction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $url = "https://fcm.googleapis.com/fcm/send";

        $usersToNotify = [];

        if($this->user != 0){
            $usersToNotify[] = $this->user;
        }
        // Notify Admins if wanted
        if($this->withAdmin){
            $admins = User::where('is_admin' , 1 )->pluck('id')->toArray();
            $usersToNotify = array_merge($usersToNotify,$admins);

        }

        $userTokens = User::whereIn('id',$usersToNotify)->pluck('firebase_token')->toArray();

        if(count($userTokens) > 0) {
            $fields = array(
                'registration_ids' => $userTokens,
                'notification' => [
                    "title" => "Delivery App",
                    "body" => $this->msg,
                    "icon" => '',
                    "click_action" => $this->clickAction
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

        Log::info("no tokens");
    }
}
