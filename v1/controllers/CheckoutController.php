<?php

require_once(__DIR__ . '/ApiController.php');

class CheckoutController extends ApiController {
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
     * REST GET Action
     * @param {String} $request /user/{action}/
     * @return {Object} login JSON response data
     **/
    public function getAction($request) {
        /* /account/{action}
            buy-amount 10000
            buy-description Buying a ticket for testing
            card-holder-email test3@test.comt
            card-holder-name Chris Runyon
            holder-phone 555-555-5555
            stripeToken tok_178dUqDE1VYFn08MNqhUA0WV
        */
        if(isset($request->url_elements[2])) {

            $action = $request->url_elements[2];
            $params = $request->parameters;

            switch($action) {
                case 'all':
                    $this->response = $this->model->getModel($action, $params);
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
        return $this->response;
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

            if ($params) {
                $this->response = $this->model->postModel($action, $params);
            }
        }

        return $this->response;
    }
}

