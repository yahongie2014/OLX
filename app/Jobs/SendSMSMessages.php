<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SendSMSMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone, $message;
    /**
     * Create a new job instance.
     * @param $phone
     * @param $message
     *
     */
    public function __construct($phone,$message)
    {
        //
        $this->phone = $phone;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $data = [
            "Username" => "966593930003",
            "Password" => "75627",
            "Tagname" => "Delivery",
            "RecepientNumber" => $this->phone,
            "VariableList" => "[Name]",
            "ReplacementList" => "Ahmed,9000",
            "Message" => $this->message,
            "SendDateTime" => 0,
            "EnableDR" => true
        ];
        $data_string = json_encode($data);


        $ch = curl_init('http://api.yamamah.com/SendSMS');
        /*$ch = curl_init();*/
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

    }
}
