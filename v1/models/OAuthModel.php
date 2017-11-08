<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/OAuthEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/security/OAuthManager.php');

class OAuthModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $user;
    protected $response;
    protected $oauthManager;

    public function getModel() {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Content-Type: text/plain');

        return;
    }

    public function postModel($action, $params = null) {
        switch($action) {
            case 'create':
                if(!empty($params)) {
                    $this->entity = new OAuthEntity();
                    $this->entity->setUserName($params['fullName']);
                    $this->entity->setUserEmail($params['email']);
                    $this->entity->setUserId($params['user_id']);
                    $this->oauthManager = new OAuthManager();
                    $this->oauthManager->attachOAuthEntity($this->entity);
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
                    header('HTTP/1.1 400 Bad Request');
                    header('Content-Type: text/plain');
                }
                break;
            default:
                header('HTTP/1.1 400 Bad Request');
                header('Content-Type: text/plain');
                break;
        }
        return $this->response;
    }

    public function getOAuthEntity() {
        return $this->entity;
    }
}


