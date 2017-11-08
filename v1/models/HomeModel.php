<?php

use OAuth1\OAuthRequestVerifier;
use OAuth1\OAuthException2;

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/HomeEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthException2.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthRequestVerifier.php');

class HomeModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $user;
    protected $user_verify;
    protected $response;

    public function getModel($url) {

        switch($url->action) {
            case 'goals':

                    $this->entity = new HomeEntity();
                    $this->sql = $this->entity->getSelectAllByCampus();
                    
                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'ftf_4yr':

                    $this->entity = new HomeEntity();
                    $this->sql = $this->entity->getSelectFTF4YR();

                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'ftf_6yr':

                    $this->entity = new HomeEntity();
                    $this->sql = $this->entity->getSelectFTF6YR();

                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'tr_2yr':

                    $this->entity = new HomeEntity();
                    $this->sql = $this->entity->getSelectTR2YR();

                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'tr_4yr':

                    $this->entity = new HomeEntity();
                    $this->sql = $this->entity->getSelectTR4YR();

                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'pell':

                    $this->entity = new HomeEntity();
                    $this->sql = $this->entity->getSelectPell6YR();

                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'urm':

                    $this->entity = new HomeEntity();
                    $this->sql = $this->entity->getSelectURM6YR();

                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            default:
                header('HTTP/1.1 400 Bad Request');
                //header('WWW-Authenticate: OAuth error="not supported"');
                header('Content-Type: text/plain');
                break;
        }
        
       return $this->response;
    }

    public function postModel() {
    	header('HTTP/1.1 405 Method Not Allowed');
    	header('Content-Type: text/plain');
    	
    	return;
    }
}
