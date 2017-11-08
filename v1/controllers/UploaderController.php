<?php

require_once(__DIR__ . '/ApiController.php');

class UploaderController extends ApiController {
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
     * @param $request
     */
    public function getAction($request) {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Content-Type: text/plain');

        return;
    }

    /**
     * @param $request
     * @return string
     */
    public function postAction($request) {
        $this->response = '{controller: null}';
        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];
            $params = $request->parameters;
            $name_dir = $_POST['name-dir'];

            $this->response = $this->model->postModel($action, $name_dir);
        }

        return $this->response;
    }
}

