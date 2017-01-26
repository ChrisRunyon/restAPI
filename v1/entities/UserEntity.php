<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/utilities/Guid.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/utilities/Obfuscator.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/7/2015
 * Time: 4:24 PM
 */
class UserEntity
{

    const SELECT_ALL_SQL = <<<EOF
SELECT *
FROM users
EOF;

    const SELECT_BY_ID_SQL = <<<EOF
SELECT *
FROM users
WHERE userId = ?
LIMIT 1
EOF;

    const SELECT_USER_PROFILE_SQL = <<<EOF
SELECT fullName, email
FROM users
WHERE userId = ?
LIMIT 1
EOF;

    const SELECT_USER_EXISTS = <<<EOF
SELECT *
FROM users
WHERE email = ?
LIMIT 1
EOF;

    const INSERT_SQL = <<<EOF
INSERT INTO `users` (`fullName`, `email`, `password`, `createdAtDate`, `userId`)
VALUES (?, ?, ?, ?, ?)
EOF;

    const UPDATE_SQL = <<<EOF
UPDATE users
SET email=?, password=?
WHERE id=?";
EOF;

    protected $fullName;
    protected $email;
    protected $password;
    protected $createdAtDate;
    protected $userId;

    public function __construct() {
        $this->table = 'users';
        $createId = new Guid();
        $guId = $createId->guid();
        $this->setUserId($guId);
    }

    public function mapData($data) {
        $obfuscate = new Obfuscator();
        $hash = $obfuscate->create_hash($data['password']);
        $this->setName($data['fullName']);
        $this->setEmail($data['email']);
        $this->setPassword($hash);
        $this->setCreatedAtDate();

        $salt = $obfuscate->getSalt();

        return $salt;
    }

    public function getInsertSql() {
        return self::INSERT_SQL;
    }

    public function getUserExists() {
        return self::SELECT_USER_EXISTS;
    }

    public function getUserProfileById() {
        return self::SELECT_USER_PROFILE_SQL;
    }

    public function getName() {
        return $this->fullName;
    }

    public function setName($name) {
        $this->fullName = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getCreatedAtDate() {
        return $this->createdAtDate;
    }

    public function setCreatedAtDate() {
        $this->createdAtDate =  date("Y-m-d H:i:s");
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId =  $userId;
    }
}


