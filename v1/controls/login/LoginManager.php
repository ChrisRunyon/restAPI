<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/31/2015
 * Time: 11:23 AM
 */
class LoginManager
{

    protected $store;
    protected $server;
    protected $request;

    public function __construct() {
        $this->store = \OAuth1\OAuthStore::instance();
        $this->server = new \OAuth1\OAuthServer();
    }

    public function authorize($params)
    {
        try {
            $this->request = $this->server->authorizeVerify();

            $this->server->authorizeFinish('allow', $params['user_id']);

        } catch (OAuthException $e) {

        }
    }

    public function is_authorized() {
        if (OAuthRequestVerifier::requestIsSigned())
        {
            try
            {
                $req = new OAuthRequestVerifier();
                $user_id = $req->verify();

                // If we have an user_id, then login as that user (for this request)
                if ($user_id)
                {
                    return true;
                }
            }
            catch (OAuthException $e)
            {
                // The request was signed, but failed verification
                header('HTTP/1.1 401 Unauthorized');
                header('WWW-Authenticate: OAuth realm=""');
                header('Content-Type: text/plain; charset=utf8');

                echo $e->getMessage();
                exit();
            }
        }
    }

}

