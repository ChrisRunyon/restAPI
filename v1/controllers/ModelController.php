<?php

require_once(__DIR__ . '/ApiController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

class ModelController extends ApiController {

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


    public function getAction($request) {
        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];

            $this->response = $this->model->getModel($action);


        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: text/plain');
            exit();
        }
        return $this->response;
    }

    /**
     * @param $request
     * @return string
     */
    public function postAction($request) {

        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];
            $params = $request->parameters;

            switch ($action) {
                case 'create':
                    if (!empty($params)) {
                        $this->response = $this->model->postModel($action, $params);
                    } else {
                        header('HTTP/1.1 400 Bad Request');
                        header('Content-Type: text/plain line 55');
                    }
                    break;
                case 'update':
                    if (!empty($params)) {
                        $this->response = $this->model->postModel($action, $params);
                    } else {
                        header('HTTP/1.1 400 Bad Request');
                        header('Content-Type: text/plain line 55');
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

