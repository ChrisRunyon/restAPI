<?php

require_once(__DIR__ . '/ApiController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

class HomeController extends ApiController {

    protected $model;
    protected $action;
    protected $params;
    protected $response;

    /**
     * Attaches Model with identical prefix
     * @param {Class} $model
     **/
    public function attachModel($model) {
        $this->model = $model;
    }

    /**
     * @param $request GET
     * @return string
     */
    public function getAction($request) {
        if(isset($request->url_elements[2]) && isset($request->url_elements[3])) {

        	$url = new URLFragments();
        	$url->action = $request->url_elements[2];
        	$url->campuscode = $request->url_elements[3];
        	
            switch ($url->action) {
                case 'goals':
                    $this->response = $this->model->getModel($url);
                    break;
                case 'ftf_4yr':
                    $this->response = $this->model->getModel($url);
                    break;
                case 'ftf_6yr':
                    $this->response = $this->model->getModel($url);
                    break;
                case 'tr_2yr':
                    $this->response = $this->model->getModel($url);
                    break;
                case 'tr_2yr':
                    $this->response = $this->model->getModel($url);
                    break;
                case 'tr_4yr':
                    $this->response = $this->model->getModel($url);
                    break;
                case 'pell':
                    $this->response = $this->model->getModel($url);
                    break;
                case 'urm':
                    $this->response = $this->model->getModel($url);
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

    /**
     * @param $request POST
     * @return string
     */
    public function postAction($request) {

        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];
            $params = $request->parameters;

            switch ($action) {
                case 'update':
                    if (!empty($params)) {
                        $this->response = $this->model->postModel($action, $params);
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

        }
        return $this->response;
    }
}

class URLFragments {
	public $action;
	public $campuscode;
}

