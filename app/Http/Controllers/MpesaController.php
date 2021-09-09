<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    private $base_url;

    private $consumer_key;

    private $consumer_secret;

    /**
     * Instantiate the class
     */
    public function __construct()
    {
        if (config('mpesa.mpesa_env') == 'sandbox') {
            $this->base_url = config('mpesa.base_url');

            $this->consumer_key = config('mpesa.consumer_key');

            $this->consumer_secret = config('mpesa.consumer_secret');
        }
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

        $passKey = config('mpesa.pass_key');

        $businessShortCode = config('mpesa.short_code');

        $payment_password = base64_encode($businessShortCode.$passKey.$payment_time);
    }
}
