<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/AccountEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/checkout/StripeManager.php');

class AccountModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $stripeManager;
    protected $user;
    protected $response;

    public function getModel() {
        header('HTTP/1.1 405 Method Not Allowed');
        header('Content-Type: text/plain');

        return;
    }

    public function postModel($action, $params = null) {
        switch($action) {
            case 'test':
                $this->entity = new AccountEntity();
                $this->stripeManager = new StripeManager($this->entity);
                $stripeAccount = $this->stripeManager->createStripeManagedAccount();
                $this->entity->mapData($params);
                $this->sql = $this->entity->getInsertSql();
                $this->data = $this->entityManager->setEntityPreflight($this->entity);
                $this->dataManager->prepInsert($this->sql, $this->data);
                break;
            case 'create':
                if(!empty($params)) {
                    $this->entity = new AccountEntity();

                    $name = $this->entity->getName();
                    $email = $this->entity->getEmail();
                    $user_id = $this->entity->getUserId();

                    //check if user already exists
                    $precheck = $this->preCheck();
                    if($precheck === false) {
                        $this->sql = $this->entity->getInsertSql();
                        $this->data = $this->entityManager->setEntityPreflight($this->entity);
                        $this->dataManager->prepInsert($this->sql, $this->data);
                        $user = array(
                            'fullName' => $name,
                            'email' => $email,
                            'user_id' => $user_id
                        );
                        $this->response = $this->entity;
                    } else {
                        $this->response = 'User exists. Choose another email address.';
                    }
                } else {
                    header('HTTP/1.1 400 Bad Request');
                    header('WWW-Authenticate: OAuth realm="params empty"');
                    header('Content-Type: text/plain');
                }
                break;
            default:
                header('HTTP/1.1 400 Bad Request');
                header('WWW-Authenticate: OAuth realm="default"');
                header('Content-Type: text/plain');
                break;
        }
        return $this->response;
    }

    public function getUserEntity() {
        return $this->entity;
    }

    public function setUserEntity($entity) {
        if(empty($this->entity)) {
            $this->entity = $entity;
        }
    }

    public function getUserSalt() {
        return $this->user;
    }

    public function setUserSalt($user) {
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
