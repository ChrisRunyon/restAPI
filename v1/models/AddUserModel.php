<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/utilities/Obfuscator.php');

class AdduserModel extends ApiModel
{
    protected $sql;
    protected $obfuscator;

    public function __construct() {
        $this->obfuscator = new Obfuscator();
    }

    public function getModel($type) {}

    public function postModel($type) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $this->obfuscator->create_hash($_POST['password']);
        $salt = $this->obfuscator->getSalt();
        $hint = $_POST['hint'];

        $sql = "INSERT INTO users (firstname, lastname, email, password, salt, hint) VALUES ('".$firstname."','".$lastname."','".$email."','".$password."','".$salt."','".$hint."')";

        return $sql;
    }
}
