<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaController extends Controller
{
    /**
     * Generate token from Mpesa
     */
    public function generateToken()
    {
        $consumer_key = getenv('MPESA_CONSUMER_KEY');
        $consumer_secret = getenv('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumer_key.":".$consumer_secret);

        $url = getenv('MPESA_URL');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $token=json_decode($curl_response);
        return $token->access_token;
    }
}
