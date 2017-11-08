<?php

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/7/2015
 * Time: 5:04 PM
 */
class IdentityEntity
{

    const INSERT_SQL = <<<EOF
INSERT INTO `identity` (`salt`, `createdAtDate`, `user_id`)
VALUES (?, ?, ?)
EOF;

    const SELECT_IDENTITY = <<<EOF
SELECT salt
FROM identity
WHERE user_id = ?
LIMIT 1
EOF;

    protected $salt;
    protected $createdAtDate;
    protected $user_id;

    public function __construct() {
        $this->table = 'identity';
        $this->setCreatedAtDate();
    }

    public function mapData($data) {
        $this->setSalt($data['salt']);
        $this->setCreatedAtDate();
    }

    public function getInsertSql() {
        return self::INSERT_SQL;
    }

    public function getIdentityExistsSql() {
        return self::SELECT_IDENTITY;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function getCreatedAtDate() {
        return $this->createdAtDate;
    }

    public function setCreatedAtDate() {
        $this->createdAtDate = date("Y-m-d H:i:s");
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id =  $user_id;
    }
}

