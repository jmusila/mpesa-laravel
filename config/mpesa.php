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
      'consumer_secret' => getenv('MPESA_CONSUMER_SECRET')
];
