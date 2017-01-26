<?php

require_once(__DIR__ . '/ApiController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/models/IdentityModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/utilities/Obfuscator.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/OAuthEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/security/OAuthManager.php');

class LoginController extends ApiController
{
    protected $model;
    protected $action;
    protected $identity;
    protected $oauth;
    protected $oauthManager;
    protected $leg1;
    protected $leg2;
    protected $leg3;
    protected $params;
    protected $response;
    protected $authentication;

    /**
     * Attaches Model with identical prefix
     * @param {Class} $model
     **/
    public function attachModel($model)
    {
        $this->model = $model;
        $this->identity = new IdentityModel();
        $this->authentication = new Obfuscator();
    }

    /**
     * REST GET Action
     * DO NOT use with authentication
     **/
    public function getAction() {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Content-Type: text/plain');

        return;
    }

    /**
     * @param $request
     * @return array
     */
    public function postAction($request)
    {
        if (isset($request->url_elements[2])) {

            $action = $request->url_elements[2];
            $params = $request->parameters;

            switch ($action) {
                case 'user':
                    if (!empty($params)) {
                        $this->leg1 = $this->model->postModel($action, $params);

                        $this->leg2 =  $this->identity->postModel('login', null, $this->leg1);

                        /* success */
                        if ($this->authentication->validate_password($params['password'], $this->leg1['password'], $this->leg2['salt']) == true) {
                            //$encrypted = $this->authentication->encrypt(json_encode($u), $iv);
                            //header('Location: http://127.0.0.1/src/#?c='.urlencode($encrypted));
                            //header('Login:' . $encrypted);
                            $user = $this->model->getIdentity();
                            $this->oauth = new OAuthEntity();
                            $this->oauth->setUserName($user['fullName']);
                            $this->oauth->setUserEmail($user['email']);
                            $this->oauth->setUserId($user['user_id']);
                            $this->oauthManager = new OAuthManager();
                            $this->oauthManager->attachOAuthEntity($this->oauth);
                            $this->oauthManager->setOAuthConsumer();
                            $this->oauthManager->registerOAuthConsumer();
                            $this->oauthManager->setOAuthServer();
                            $this->oauthManager->registerOAuthServer();
                            $this->oauthManager->requestOAuthRequestToken();
                            $this->oauthManager->requestOAuthAccessToken();
                            $this->oauthManager->generateOAuthSignature();
                            $auth = $this->oauthManager->buildOAuthParams();

                            $this->response = $auth;

                        } else {
                            header('HTTP/1.1 401 Unauthorized');
                            header('Content-Type: text/plain');
                        }
                    } else {
                        header('HTTP/1.1 400 Bad Request');
                        header('Content-Type: text/plain');
                    }
                    break;
                default:
                    header('HTTP/1.1 400 Bad Request');
                    header('Content-Type: text/plain');
                    break;
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: text/plain');
        }
        return $this->response;
    }
}
