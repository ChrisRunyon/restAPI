<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/UserEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1//entities/StripeEntity.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/checkout/StripeManager.php');

class CheckoutModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $stripeManager;
    protected $mapData;
    protected $response;

    public function getModel($userId, $action) {
    }

    public function postModel($action, $params = null) {

        switch($action) {
            case 'purchase':
                $this->entity = new StripeEntity();
                $this->sql = $this->entity->getInsertSql();
                $this->entity->mapData($params);
                $this->stripeManager = new StripeManager($this->entity);
                $this->stripeManager->mapData($params);
                $this->data = $this->entityManager->setEntityPreflight($this->entity);
                $this->response = $this->dataManager->prepInsert($this->sql, $this->data);
                $this->stripeManager->createCharge();
                break;
            default:
                break;
        }
        return $this->response;
    }
}
