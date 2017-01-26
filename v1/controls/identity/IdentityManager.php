<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/IdentityEntity.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/1/2015
 * Time: 2:42 PM
 */
class IdentityManager
{

    protected $salt;
    protected $identityEntity;
    protected $userEntity;

    public function __construct($entity) {
        $this->userEntity = $entity;
        $this->identityEntity = new IdentityEntity();
    }

    public function getIdentityEntity() {
        return $this->identityEntity;
    }

    public function getUserEntity() {
        return $this->userEntity;
    }

    public function setIdentitySalt($salt) {
        if(!empty($this->identityEntity)) {
            $this->identityEntity->setSalt($salt);
        }
    }

    public function setIdentityId($user_id) {
        if(!empty($this->userEntity)) {
            $id = $this->userEntity->getUserId();
        }
        if($id === $user_id) {
            $this->identityEntity->setUserId($id);
        } else {
            throw new ErrorException('user_id does not match');
        }
    }

    public function getIdentityInsertSql() {
        if(!empty($this->identityEntity)) {
            $sql = $this->identityEntity->getInsertSql();
        }

        return $sql;
    }

    public function getIdentityExistsSql() {
        if(!empty($this->entity)) {
            $sql = $this->entity->getIdentityExistsSql();
        }

        return $sql;
    }
}
