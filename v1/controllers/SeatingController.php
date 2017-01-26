<?php

require_once(__DIR__ . '/ApiController.php');

class SeatingController extends ApiController {
    protected $model;
    protected $action;
    protected $response;

    /**
    * Attaches Model with identical prefix
    * @param {Class} $model
    **/
    public function attachModel($model) {
        $this->model = $model;
    }

    /**
    * REST GET Action
    * @param {String} $request /account/{action}/
    * @return {Object} login JSON response data
    **/
    public function getAction($request) {

        /* /account/{action} */
        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];

            switch($action) {
                case 'all':
                    $this->response = $this->model->getModel($action);
                    break;
                default:
                    // do nothing, this is not a supported action
                    $data['message'] = "action not supported";
                    break;
            }
        }
        else
        {
            $data['message'] = "no action provided no action taken";
        }
        //echo($this->response);
        return $this->response;
    }

    /**
    * REST POST Action
    * @param {String} $request /account/{id}/{action}
    * @return {Object} login JSON response data
    **/
    public function postAction($request) {
         /* /account/{id}/action */
        if(isset($request->url_elements[2])) {

            $userId = (int)$request->url_elements[2];

            if(isset($request->url_elements[3])) {

                $action = $request->url_elements[3];
                $params = $request->parameters;

                /*switch($action) {
                case 'create':
                    $connection = $this->getConnection();

                    $results = $connection->query($this->model->postModel($params));

                    break;
                case 'upload':
                    $connection = $this->getConnection();
                    $results = $connection->query($this->model->postModel($params));
                    break;
                }*/
            }
        }
        $data = $request->parameters;
        $data['message'] = "This data was submitted";
        return $data;
    }
}

