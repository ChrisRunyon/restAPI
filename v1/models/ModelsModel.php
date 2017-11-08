<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/ModelEntity.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/11/2015
 * Time: 5:51 PM
 */

class ModelsModel extends ApiModel {

    protected $sql;
    protected $data;
    protected $entity;
    protected $mapData;
    protected $response;
    protected $user_verify;
    protected $i;

    public function getModel($action) {

        if ($action) {
            switch($action) {
                case 'all':
                    $this->entity = new ModelEntity();
                    $this->sql = $this->entity->getSelectAllSql();
                    $this->response =  $this->dataManager->prepSelectAll($this->sql);
                    break;
                default:
                    header('HTTP/1.1 400 Bad Request');
                    header('Content-Type: text/plain');
                    break;
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: text/plain');
            exit();
        }
        return $this->response;
    }

    /**
     * @param $action
     * @param null $params
     * @return string
     */
    public function postModel($action, $params = null) {
        if ($action) {
            switch($action) {
                case 'all':
                    $this->entity = new ModelEntity();
                    $this->sql = $this->entity->getSelectAllSql();
                    $results =  $this->dataManager->prepSelectAll($this->sql);
                    $this->response = $results;
                    break;
                case 'search':
                    $this->entity = new ModelEntity();
                    $keywords = $params['keywords'];
                    //var_dump($keywords);
                    $terms = explode(" ", $keywords);
                    $this->sql = "SELECT * FROM model_mode WHERE ";
                    $this->i = 0;
                    foreach($terms as $each) {
                        $this->i++;
                        if($this->i == 1) {
                            $this->sql .= "keywords LIKE '%$each%' ";
                        } else {
                            $this->sql .= "OR keywords LIKE '%$each%' ";
                        }

                    }
                    $results =  $this->dataManager->prepSelectAll($this->sql);
                    $this->response = $results;
                    break;
                default:
                    header('HTTP/1.1 400 Bad Request');
                    header('Content-Type: text/plain');
                    break;
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: text/plain');
            exit();
        }

        return $this->response;
    }

}