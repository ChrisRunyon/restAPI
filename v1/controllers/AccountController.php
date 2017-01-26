<?php

require_once(__DIR__ . '/ApiController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/models/IdentityModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/models/OAuthModel.php');

class AccountController extends ApiController {

    protected $model;
    protected $identity;
    protected $oauth;
    protected $action;
    protected $params;
    protected $leg1;
    protected $leg2;
    protected $leg3;
    protected $response;
    protected $authentication;

    /**
     * Attaches Model with identical prefix
     * @param {Class} $model
     **/
    public function attachModel($model) {
        $this->model = $model;
        $this->identity = new IdentityModel();
        $this->oauth = new OAuthModel();
    }

    /**
     * REST GET Action
     **/
    public function getAction() {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Content-Type: text/plain');

        return;
    }

    /**
     * REST POST Action
     * @param {String} $request /user/{id}/{action}
     * @return {Object} login JSON response data
     **/
    public function postAction($request) {
        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];
            $params = $request->parameters;

            switch($action) {
                case 'test':
                    if (!empty($params)) {
                        $this->model->postModel($action, $params);
                    } else {
                        header('HTTP/1.1 400 Bad Request');
                        header('Content-Type: text/plain');
                    }
                    break;
                case 'create':
                    if (!empty($params)) {
                        //check if user exists else generate salt
                        $this->leg1 = $this->model->postModel($action, $params);
                        //store salt and user_id in identity table
                        $this->leg2 = $this->identity->postModel($action, $this->model->getUserEntity(), $this->model->getUserSalt());
                        //generate OAuth signed requests with name, email
                        $this->leg3 = $this->oauth->postModel($action, $this->model->getUserSalt());

                        $this->response = $this->leg3;
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
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: text/plain');
        }

        return $this->response;
    }
}

