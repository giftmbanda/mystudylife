<?php

namespace App\SMS;

use Log;
use StdClass;
use SimpleXMLElement;

class MobileAPI
{
    public static function sendSms($cellphones, $message)
    {
        Log::info('--------  START SMS --------');

        $result = self::submitSmsBatch($cellphones, $message);

        Log::info('-------- FINISH SMS --------');
    }

    private static function submitSmsBatch($cellphoneNumber, $msg)
    {
        $data = array(
            'Type' => 'sendparam', 
            'Username' => env('MY_MOBILE_API_USERNAME', 'Integration'),
            'Password' => env('MY_MOBILE_API_PASSWORD', ''),
            'numto' => $cellphoneNumber, //phone numbers (can be comma seperated)
            'data1' => $msg, //your sms message
            'return_entries_success_status' => true,
            'return_entries_failed_status' => true,
        );

        $response = self::querySmsServer($data);

        return self::returnResult($response);
    }

    // query API server and return response in object format
    private static function querySmsServer($data, $optional_headers = null)
    {
        $ch = curl_init(env('MY_MOBILE_API_URL', 'http://www.mymobileapi.com/api5/http5.aspx'));

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // prevent large delays in PHP execution by setting timeouts while connecting and querying the 3rd party server
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 2000); // response wait time
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000); // output response time

        $response = curl_exec($ch);

        if (!$response) 
        {
            return NULL;
        }
        else 
        {
            return new SimpleXMLElement($response);
        }
    }

    // handle sms server response
    private static function returnResult($response)
    {
        $return = new StdClass();
        $return->pass = NULL;
        $return->msg = '';

        if ($response == NULL)
        {
            $return->pass = FALSE;
            $return->msg = 'SMS connection error.';

            Log::error("SMS API unreachable!");
        } 
        elseif ($response->call_result->result) 
        {
            $return->pass = 'CallResult: '.TRUE . '\n';
            $return->msg = 'EventId: '.$response->send_info->eventid .'\nError: '.$response->call_result->error;
        } 
        else 
        {
            $return->pass = 'CallResult: '.FALSE. '\n';
            $return->msg = 'Error: '.$response->call_result->error;

            Log::error('SMS Error : ' . $response->call_result->error);
        }

        Log::info($return->pass); 
        Log::info($return->msg); 

        return $return; 
    }

    // Check the credits left on the server.
    public static function checkCredits() {
        $data = array(
            'Type' => 'credits', 
            'Username' => env('MY_MOBILE_API_USERNAME', 'Integration'),
            'Password' => env('MY_MOBILE_API_PASSWORD', '')
        );
        
        $response = self::querySmsServer($data);
        
        // NULL response only if connection to sms server failed or timed out
        if ($response == NULL) 
        {
            return '???';
        } 
        elseif ($response->call_result->result) 
        {
            Log::info('Credits: ' .  $response->data->credits);

            return $response->data->credits;
        }
    }
}