<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/EventEntity.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/11/2015
 * Time: 5:51 PM
 */

class EventsModel extends ApiModel {

    protected $sql;
    protected $data;
    protected $entity;
    protected $mapData;
    protected $response;
    protected $user_verify;

    public function getModel($action) {

        if ($action) {
            switch($action) {
                case 'all':
                    $this->entity = new EventEntity();
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
                    $this->entity = new EventEntity();
                    $this->sql = $this->entity->getSelectAllSql();
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