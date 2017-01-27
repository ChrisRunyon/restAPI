<?php

require_once(__DIR__ . '/ApiController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/utilities/Obfuscator.php');

class AdduserController extends ApiController {

    public $connection;
    private $model;
    private $action;
    private $authentication;

    /**
    * Attaches Model with identical prefix
    * @param {Class} $model
    **/
    public function attachModel($model) {
        $this->model = $model;
        $this->authentication = new Obfuscator();
    }

    /**
    * REST GET Action
    * DO NOT use with authentication
    **/
    public function getAction($request) {
        /**
        * Intentionally left blank
        * not safe to use get in authentication
        **/
    }

    public function postAction($request) {
	 /* /Users/{id} */
        if(isset($request->url_elements[2])) {

            $type = $request->url_elements[2];

            switch($type) {
                /* controller login to admin */
                case 'user':
                    $connection = $this->getConnection();
                    $results = $connection->query($this->model->postModel($type));
                    echo json_encode('{result: success}');
                    exit;
                    $connection->close();
                    break;
                /* controller login to localhost main site */
                case 'admin':
                    echo "login to user main site, build later.";
                    break;
                case 'client':
                    break;
            }
        } else {
           echo "Please choose a login type. (admin/localhost)";
        }
        //return $data;
    }
}

