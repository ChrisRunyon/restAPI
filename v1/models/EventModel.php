<?php

use OAuth1\OAuthRequestVerifier;
use OAuth1\OAuthException2;

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/EventEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthException2.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthRequestVerifier.php');



class EventModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $mapData;
    protected $response;
    protected $user_verify;

    public function getModel($action) {
        if ($action) {
            $page = rawurlencode("/event/".$action);
            $this->entity = new EventEntity();
            $this->sql = $this->entity->getSelectByLinkSql();
            $this->response =  $this->dataManager->prepSelectByURL($this->sql, $page);

        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: text/plain');
            exit();
        }
        return $this->response;
    }

    /**
     * @param $action
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
                    switch($action) {
                        case 'create':
                            $this->entity = new EventEntity();
                            $this->sql = $this->entity->getInsertSql();
                            $this->entity->mapData($params);
                            $this->data = $this->entityManager->setEntityPreflight($this->entity);
                            $this->dataManager->prepInsert($this->sql, $this->data);
                            $this->response = "";
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

            //useful for debugging
            //$headers = apache_request_headers();
            //foreach ($headers as $header => $value) {
            //    echo "$header: $value <br />\n";
            //}
        }
        return $this->response;
    }
}
