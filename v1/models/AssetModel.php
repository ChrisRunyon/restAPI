<?php

use OAuth1\OAuthRequestVerifier;
use OAuth1\OAuthException2;

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthException2.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthRequestVerifier.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/ModelEntity.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/11/2015
 * Time: 5:51 PM
 */

class AssetModel extends ApiModel {

    protected $sql;
    protected $data;
    protected $entity;
    protected $mapData;
    protected $response;
    protected $user_verify;

    /**
     * @param $action GET 
     * @param null $params
     * @return string
     */
    public function getModel($action) {
        if (OAuthRequestVerifier::requestIsSigned()) {
            try {
                $req = new OAuthRequestVerifier();
                $this->user_verify = $req->verify();

                // If we have an user_id, then login as that user (for this request)
                if ($this->user_verify) {

                    $this->response = '{data: failed}';
                    switch($action) {
                        case 'user':
                            $this->entity = new ModelEntity();
                            $this->sql = $this->entity->getSelectAllByUserIdSql();
                            $results = $this->dataManager->prepSelectByUserId($this->sql, $this->user_verify);
                            $this->response = $results;
                            break;
                        default:
                            header('HTTP/1.1 400 Bad Request');
                            header('Content-Type: text/plain');
                            break;
                    }
                }
            } catch (OAuthException2 $e) {
                // The request was signed, but failed verification
                header('HTTP/1.1 401 Unauthorized');
                header('WWW-Authenticate: OAuth realm="not verified"');
                header('Content-Type: text/plain; charset=utf8');

                exit();
            }
        } else {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: OAuth realm="not signed"');
            header('Content-Type: text/plain; charset=utf8');

            exit();
        }
        return $this->response;
    }

    /**
     * @param $action POST 
     * @param null $params
     * @return string
     */
    public function postModel($action, $params = null) {
        if (OAuthRequestVerifier::requestIsSigned()) {
            try {
                $req = new OAuthRequestVerifier();
                $this->user_verify = $req->verify();

                // If we have an user_id, then login as that user (for this request)
                if ($this->user_verify) {

                    $this->response = '{data: failed}';
                    switch($action) {

                        case 'update':
                            $this->entity = new ModelEntity();
                            $this->sql = $this->entity->getSelectAllSql();
                            $results =  $this->dataManager->prepSelectAll($this->sql);
                            $this->response = $results;
                            break;
                        default:
                            header('HTTP/1.1 400 Bad Request');
                            header('Content-Type: text/plain');
                            break;
                    }
                }
            } catch (OAuthException2 $e) {
                // The request was signed, but failed verification
                header('HTTP/1.1 401 Unauthorized');
                header('WWW-Authenticate: OAuth realm="not verified"');
                header('Content-Type: text/plain; charset=utf8');

                exit();
            }
        } else {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: OAuth realm="not signed"');
            header('Content-Type: text/plain; charset=utf8');

            exit();
        }
        return $this->response;
    }
}