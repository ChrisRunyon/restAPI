<?php

require_once(__DIR__ . '/ApiController.php');

class PasswdMgrController extends ApiController {
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
    * @param {String} $request /user/{action}/
    * @return {Object} login JSON response data
    **/
    public function getAction($request) {

        /* /user/{action} */
        if(isset($request->url_elements[2])) {

            $command = $request->url_elements[2];

            switch($command) {
                case 'all' :
                    $connection = $this->getConnection();
                    $results = $connection->query($this->model->getModel(null, $command));
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
                    $rowId = (int)$request->url_elements[2];
                    break;
            }
            /* /user/{id}/{action} */
            if(isset($request->url_elements[3])) {

                $action = $request->url_elements[3];

                switch($action) {
                    case 'edit':
                        $connection = $this->getConnection();
                        $results = $connection->query($this->model->getModel($rowId, $action));
                        $keys = array_keys($results);
                        $last = count($results[$keys[0]]);
                        for($i = 0; $i < $last; $i++) {
                            foreach ($results as $key => $value) {
                                $data['result'][$key] = $value;
                            }
                        }
                        $connection->close();
                        break;
                    case 'search':
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
                        $data['message'] = "action not supported";
                        break;
                }
            } else {
                $data['message'] = "no valid userid provided: " . $userId;
            }
        }
        else
        {
            $data['message'] = "you want a list of credentials?";
        }
        return $data;
    }

    /**
    * REST POST Action
    * @param {String} $request /user/{id}/{action}
    * @return {Object} login JSON response data
    **/
    public function postAction($request) {
         /* /Users/{id} */
        if(isset($request->url_elements[2])) {
            $action = $request->url_elements[2];
            $params = $request->parameters;
            foreach($params as $index) {
                echo "$index\n";
            }

            switch($action) {
                case 'create':
                    $connection = $this->getConnection();
                    $results = $connection->query($this->model->postModel($action, $params));
                    break;
                default:
                    $rowId = (int)$request->url_elements[2];
                    break;
            }

            if(isset($request->url_elements[3])) {
                $action = $request->url_elements[3];
                switch($action) {
                    case 'edit':
                        $connection = $this->getConnection();
                        $results = $connection->query($this->model->postModel($action, $rowId));
                        break;
                    default:
                        break;
                }

            }
        }
        $data = $request->parameters;
        $data['message'] = "This data was submitted";
        return $data;
    }
}

