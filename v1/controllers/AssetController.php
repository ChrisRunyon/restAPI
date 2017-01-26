<?php

require_once(__DIR__ . '/ApiController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

class AssetController extends ApiController {

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
        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];

            switch ($action) {
                case 'user':
                    $this->response = $this->model->getModel($action);
                    break;
                default:
                    header('HTTP/1.1 400 Bad Request');
                    header('Content-Type: text/plain');
                    break;
            }

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

