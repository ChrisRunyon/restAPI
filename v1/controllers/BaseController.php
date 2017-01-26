<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/base/ApiController.php');

class BaseController extends ApiController {
    public $connection;
    private $model;
    private $action;

    public function attachModel($model) {
        $this->model = $model;
    }

    /* /Users */
    public function getAction($request) {

        /* /Users/{id} */
        if(isset($request->url_elements[2])) {

            $userId = (int)$request->url_elements[2];

            /* /Users/{id}/{action} */
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
                        $data['message'] = "user " . $user_id . " action not supported";
                        break;
                }
            } else {
                $data['message'] = "here is the info for user " . $user_id;
            }
        } else {
            $data['message'] = "you want a list of users";
        }
        return $data;
    }

    public function postAction($request) {
         /* /Users/{id} */
        if(isset($request->url_elements[2])) {
            $user_id = (int)$request->url_elements[2];
            if(isset($request->url_elements[3])) {
                $action = $request->url_elements[3];
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
        }
        $data = $request->parameters;
        $data['message'] = "This data was submitted";
        return $data;
    }
}

