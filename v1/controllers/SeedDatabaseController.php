<?php

require_once(__DIR__ . '/ApiController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

class SeedDatabaseController {
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


    public function getAction() {
        $this->response = $this->model->postModel();

        return $this->response;
    }

    public function postAction() {

        $this->response = $this->model->postModel();

        return $this->response;
    }
}

