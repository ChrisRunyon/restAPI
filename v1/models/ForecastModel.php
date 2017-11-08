<?php

use OAuth1\OAuthRequestVerifier;
use OAuth1\OAuthException2;

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/ForecastEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthException2.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthRequestVerifier.php');

class ForecastModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $user;
    protected $user_verify;
    protected $response;

    public function getModel($url) {

        switch($url->action) {
            case 'ftf_4yr':

                    $this->entity = new ForecastEntity();
                    $this->sql = $this->entity->getSelectFTF4YR();
                    
                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'ftf_6yr':

                    $this->entity = new ForecastEntity();
                    $this->sql = $this->entity->getSelectFTF6YR();
                    
                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'ftf_6yr_pell':
            	
            		$this->entity = new ForecastEntity();
            		$this->sql = $this->entity->getSelectFTF6YRPell();
            		
            		$results = $this->dataManager->prepSelectGradRates($this->sql, $url);
            		$this->response = $results;
            		
            	break;
            
            case 'ftf_6yr_nonpell':
            	
            		$this->entity = new ForecastEntity();
            		$this->sql = $this->entity->getSelectFTF6YRNonPell();
            		
            		$results = $this->dataManager->prepSelectGradRates($this->sql, $url);
            		$this->response = $results;
            	
            	break;
            	
            case 'ftf_6yr_urm':
            	
            		$this->entity = new ForecastEntity();
            		$this->sql = $this->entity->getSelectFTF6YRURM();
            		
            		$results = $this->dataManager->prepSelectGradRates($this->sql, $url);
            		$this->response = $results;
            	
            	break;
            	
            case 'ftf_6yr_nonurm':
            	
            		$this->entity = new ForecastEntity();
            		$this->sql = $this->entity->getSelectFTF6YRNonURM();
            		
            		$results = $this->dataManager->prepSelectGradRates($this->sql, $url);
            		$this->response = $results;
            	
            	break;
                
            case 'tr_2yr': 
            	
            		$this->entity = new ForecastEntity();
            		$this->sql = $this->entity->getSelectTR2YR();
            		
            		$results = $this->dataManager->prepSelectGradRates($this->sql, $url);
            		$this->response = $results;
            	
            	break;
            	
            case 'tr_4yr':
            	
            		$this->entity = new ForecastEntity();
            		$this->sql = $this->entity->getSelectTR4YR();
            		
            		$results = $this->dataManager->prepSelectGradRates($this->sql, $url);
            		$this->response = $results;
            	
            	break;
            
            case 'ftf_45yr':

                    $this->entity = new ForecastEntity();
                    $this->sql = $this->entity->getSelectFTF45YR();
                    
                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'ftf_65yr':

                    $this->entity = new ForecastEntity();
                    $this->sql = $this->entity->getSelectFTF65YR();
                    
                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;

                break;
            case 'ftf_65yr_pell':
                
                    $this->entity = new ForecastEntity();
                    $this->sql = $this->entity->getSelectFTF65YRPell();
                    
                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;
                    
                break;
                
            case 'ftf_65yr_urm':
                
                    $this->entity = new ForecastEntity();
                    $this->sql = $this->entity->getSelectFTF65YRURM();
                    
                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;
                
                break;
                
            case 'tr_25yr': 
                
                    $this->entity = new ForecastEntity();
                    $this->sql = $this->entity->getSelectTR25YR();
                    
                    $results = $this->dataManager->prepSelectGradRates($this->sql, $url);
                    $this->response = $results;
                
                break;
                
            case 'tr_45yr':
                
                    $this->entity = new ForecastEntity();
                    $this->sql = $this->entity->getSelectTR45YR();
                    
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
