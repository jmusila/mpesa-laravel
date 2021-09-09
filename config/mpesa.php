<?php

return [
    /**
     * ------------------------------------
     * MPESA ENVIRONMENT CONFIGURATION
     * ------------------------------------
     */

     'mpesa_env' => getenv('MPESA_ENV'),


     /**
      * ------------------------------------
      * MPESA CONSUMER KEY
      * ------------------------------------
      */
      'consumer_key' => getenv('MPESA_CONSUMER_KEY'),


    /**
      * ------------------------------------
      * MPESA BASE URL
      * ------------------------------------
      */
      'base_url' => getenv('MPESA_BASE_URL'),


    /**
      * ------------------------------------
      * MPESA SECRET KEY
      * ------------------------------------
      */
      'consumer_secret' => getenv('MPESA_CONSUMER_SECRET'),

    /**
     * --------------------------------------------------
     * MPESA PASS KEY
     * --------------------------------------------------
     */
    'pass_key' => getenv('MPESA_PASS_KEY'),

    /**
     * --------------------------------------------------
     * MPESA BUSINESS CODE
     * --------------------------------------------------
     */
    'business_code' => getenv('MPESA_BUSINESS_CODE'),

    /**
     * --------------------------------------------------
     * MPESA STK URL
     * --------------------------------------------------
     */
    'stk_url' => getenv('MPESA_STK_URL'),

    /**
     * --------------------------------------------------
     * MPESA CALL BACK URL
     * --------------------------------------------------
     */
    'call_back_url' => getenv('MPESA_CALL_BACK_URL')
];
