<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    private $base_url;

    private $consumer_key;

    private $consumer_secret;

    private $passKey;

    private $businessShortCode;

    private $stk_url;

    /**
     * Instantiate the class
     */
    public function __construct()
    {
        if (config('mpesa.mpesa_env') == 'sandbox') {
            $this->base_url = config('mpesa.base_url');

            $this->consumer_key = config('mpesa.consumer_key');

            $this->consumer_secret = config('mpesa.consumer_secret');

            $this->passKey = config('mpesa.pass_key');

            $this->businessShortCode = config('mpesa.business_code');

            $this->stk_url = config('mpesa.stk_url');
        }
    }

    /**
     * Prompt customer STK push
     */
    public function customerSTKPush()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->stk_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateToken()));
        $curl_post_data = [
            'BusinessShortCode' => $this->businessShortCode,
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => 1,
            'PartyA' => env('MPESA_MOBILE_NUMBER'),
            'PartyB' => $this->businessShortCode,
            'PhoneNumber' => env('MPESA_MOBILE_NUMBER'),
            'CallBackURL' => 'https://cleangenesis.com/path',
            'AccountReference' => "Clean Genesis",
            'TransactionDesc' => "Testing stk push on sandbox"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    /**
     * Generate token from Mpesa
     */
    public function generateToken()
    {
        $credentials = base64_encode($this->consumer_key.":".$this->consumer_secret);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->base_url . "/oauth/v1/generate?grant_type=client_credentials");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $token=json_decode($curl_response);
        return $token->access_token;
    }

    /**
     * Generate Lipa na Mpesa Password
     */
    public function lipaNaMpesaPassword()
    {
        $payment_time = Carbon::rawParse('now')->format('YmdHms');

        return base64_encode($this->businessShortCode.$this->passKey.$payment_time);
    }
}
