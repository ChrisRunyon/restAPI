<?php

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/7/2015
 * Time: 4:24 PM
 */
class LoginEntity
{

    const SELECT_USER = <<<EOF
SELECT fullName, email, password, userId
FROM users
WHERE email = ?
LIMIT 1
EOF;

    protected $email;
    protected $password;

    public function __construct() {
        $this->table = 'users';
    }

    public function mapData($data) {
        $this->setEmail($data['email']);
        $this->setPassword($data['password']);
    }

    public function getUserExists() {
        return self::SELECT_USER;
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
}


