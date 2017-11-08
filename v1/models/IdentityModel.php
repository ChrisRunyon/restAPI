<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/IdentityEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/identity/IdentityManager.php');

class IdentityModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $identityManager;
    protected $response;

    public function getModel() {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Content-Type: text/plain');

        return;
    }

    public function postModel($action, $userEntity, $userSalt) {
        switch($action) {
            case 'create':
                if(!empty($userEntity) && !empty($userSalt)) {
                    $this->identityManager = new IdentityManager($userEntity);
                    $this->identityManager->setIdentitySalt($userSalt['salt']);
                    $this->identityManager->setIdentityId($userSalt['user_id']);
                    $this->sql = $this->identityManager->getIdentityInsertSql();
                    $this->data = $this->entityManager->setEntityPreflight($this->identityManager->getIdentityEntity());
                    $result = $this->dataManager->prepInsert($this->sql, $this->data);
                    $this->response = $result;
                } else {
                    header('HTTP/1.1 400 Bad Request');
                    header('Content-Type: text/plain');
                }
                break;
            case 'login':
                if(!empty($userSalt)) {
                    $this->entity = new IdentityEntity();
                    $this->entity->setUserId($userSalt['user_id']);
                    $this->sql = $this->entity->getIdentityExistsSql();
                    $data = array(
                        'user_id' => $userSalt['user_id']
                    );
                    $result = $this->dataManager->prepSelect($this->sql, $data);

                    $this->response = $result;
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
}
