<?php

require_once(__DIR__ . '/ApiController.php');

class VideosController extends ApiController {
    public $connection;
    private $model;
    private $action;

    /**
    * Attaches Model with identical prefix
    * @param {Class} $model
    **/
    public function attachModel($model) {
        $this->model = $model;
    }

    /**
    * REST GET Action
    * @param {String} $request /videos/{id}/{action}/
    * @return {Object} login JSON response data
    **/
    public function getAction($request) {

        /* /videos/{id} */
        if(isset($request->url_elements[2])) {
            $userId = (int)$request->url_elements[2];

            /* /videos/{id}/{action} */
            if(isset($request->url_elements[3])) {

                $action = $request->url_elements[3];

                switch($action) {
                    case 'friends':
                        $connection = $this->getConnection();
                        $results = $connection->query($this->model->getModel($action));
                        $keys = array_keys($results);
                        $last = count($results[$keys[0]]);
                        for($i = 0; $i < $last; $i++) {
                            foreach ($results as $key => $value) {
                                $data['result'][$key] = $value;
                            }
                        }
                        $connection->close();
                        break;
                    case 'enemies':
                        $connection = $this->getConnection();
                        $results = $connection->query($this->model->getModel($action));
                        $keys = array_keys($results);
                        $last = count($results[$keys[0]]);
                        for($i = 0; $i < $last; $i++) {
                            foreach ($results as $key => $value) {
                                $data['result'][$key] = $value;
                            }
                        }
                        $connection->close();
                        break;
                    default:
                        // do nothing, this is not a supported action
                        $data['message'] = "user " . $userId . " action not supported";
                        break;
                }
            } else {
                $data['message'] = "here is the info for user " . $userId;
            }
        } else {
            $data['message'] = "you want a list of users";
        }
        return $data;
    }

    /**
    * REST POST Action
    * @param {String} $request /videos/{action}
    * @return {Object} login JSON response data
    **/
    public function postAction($request) {

        /* /videos/{action} */
        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];
            $params = $request->parameters;

            switch($action) {
                case 'create':
                    $connection = $this->getConnection();
                    echo "before";
                    $results = $connection->query($this->model->postModel($params));
                    echo "after";
                    break;
                case 'upload':
                    $connection = $this->getConnection();
                    $results = $connection->query($this->model->postModel($params));
                    break;
            }
        }
        $data = $request->parameters;
        $data['message'] = "This data was submitted";
        return $data;
    }
}

