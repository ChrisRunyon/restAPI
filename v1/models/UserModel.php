<?php

use OAuth1\OAuthRequestVerifier;
use OAuth1\OAuthException2;

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/UserEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthException2.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthRequestVerifier.php');

class UserModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $user;
    protected $user_verify;
    protected $response;

    public function getModel($action) {
        if (OAuthRequestVerifier::requestIsSigned()) {
            try {
                $req = new OAuthRequestVerifier();
                $this->user_verify = $req->verify();

                // If we have an user_id, then login as that user (for this request)
                if ($this->user_verify) {
                    switch($action) {
                        case 'profile':

                                $this->entity = new UserEntity();
                                $this->sql = $this->entity->getUserProfileById();
                                $results = $this->dataManager->prepSelectById($this->sql, $this->user_verify);
                                $this->response = $results;

                            break;
                        default:
                            header('HTTP/1.1 400 Bad Request');
                            header('WWW-Authenticate: OAuth error="not supported"');
                            header('Content-Type: text/plain');
                            break;
                    }

                } else {
                    header('HTTP/1.1 401 Unauthorized');
                    header('WWW-Authenticate: OAuth error="not signed"');
                    header('Content-Type: text/plain; charset=utf8');
                }

            } catch (OAuthException2 $e) {
                // The request was signed, but failed verification
                header('HTTP/1.1 401 Unauthorized');
                header('WWW-Authenticate: OAuth error="not verified"');
                header('Content-Type: text/plain; charset=utf8');

                exit();
            }
        }
        return $this->response;
    }

    public function postModel($action, $params = null) {
        switch($action) {
            case 'create':
                if(!empty($params)) {
                    $this->entity = new UserEntity();

                    //returns salt
                    $salt = $this->entity->mapData($params);

                    $name = $this->entity->getName();
                    $email = $this->entity->getEmail();
                    $user_id = $this->entity->getUserId();

                    //check if user already exists
                    $precheck = $this->preCheck();
                    if($precheck === false) {
                        //get SQL statement
                        $this->sql = $this->entity->getInsertSql();
                        //prep array properties
                        $this->data = $this->entityManager->setEntityPreflight($this->entity);
                        //commit to database
                        $this->dataManager->prepInsert($this->sql, $this->data);
                        //create return array
                        $user = array(
                            'fullName' => $name,
                            'email' => $email,
                            'salt' => $salt,
                            'user_id' => $user_id
                        );
                        //why ?
                        $this->setUserSalt($user);
                        //return the entire entity?
                        $this->response = $this->entity;
                    } else {
                        $this->response = 'User exists. Choose another email address.';
                    }
                } else {
                    header('HTTP/1.1 400 Bad Request');
                    header('WWW-Authenticate: OAuth error="params empty"');
                    header('Content-Type: text/plain');
                }
                break;
            default:
                header('HTTP/1.1 400 Bad Request');
                header('WWW-Authenticate: OAuth error="not supported"');
                header('Content-Type: text/plain');
                break;
        }
        return $this->response;
    }

    public function getUserEntity() {
        return $this->entity;
    }

    public function setUserEntity($entity) {
        if(empty($this->entity)) {
            $this->entity = $entity;
        }
    }

    public function getUserSalt() {
        return $this->user;
    }

    public function setUserSalt($user) {
        $this->user = $user;
    }

    public function preCheck() {
        $sql = $this->entity->getUserExists();
        $data = array(
            'email' => $this->entity->getEmail()
        );
        $result = $this->dataManager->prepSelect($sql, $data);

        return $result;
    }
}
