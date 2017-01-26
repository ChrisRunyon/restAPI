<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/LoginEntity.php');

class LoginModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $mapData;
    protected $response;
    protected $user;

    public function getModel() {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Content-Type: text/plain');

        return null;
    }

    public function postModel($action, $params = null) {
        switch($action) {
            case 'user':
                if(!empty($params)) {
                    $this->entity = new LoginEntity();
                    $this->entity->mapData($params);
                    $preCheck = $this->preCheck();
                    if($preCheck) {
                        $user = [
                            'fullName' => $preCheck['fullName'],
                            'email' => $preCheck['email'],
                            'password' => $preCheck['password'],
                            'user_id' => $preCheck['userId']
                        ];

                        $this->setIdentity($user);
                        $this->response = $this->getIdentity();
                    } else {
                        $this->response = 'Invalid Email address or Password';
                    }
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
        return $this->response;
    }

    public function getIdentity() {
        return $this->user;
    }

    public function setIdentity($user) {
        $this->user = $user;
    }

    public function preCheck() {
        $sql = $this->entity->getUserExists();
        $data = array(
            'email' => $this->entity->getEmail()
        );
        $result = $this->dataManager->prepSelect($sql, $data);

        return $result;
    }
}
