<?php

abstract class ApiController {

    public function __construct() {
    }

    //Needed for CORS preflight request
    public function optionsAction() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Max-Age: 1000");
        header("Access-Control-Allow-Headers: x-csrf-token, x-requested-with, Content-Type, origin, authorization, Accept, oauth_consumer_key,oauth_nonce,oauth_signature,oauth_signature_method,oauth_timestamp,oauth_token,oauth_version");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    }
}

