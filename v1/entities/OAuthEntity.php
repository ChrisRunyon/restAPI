<?php


class OAuthEntity {

    protected $userName;
    protected $userEmail;
    protected $user_id;
    protected $consumerId;
    protected $consumerKey;
    protected $consumerSecret;
    protected $requestToken;

    public function __construct() {}

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($username) {
        $this->userName = $username;
    }

    public function getUserEmail() {
        return $this->userEmail;
    }

    public function setUserEmail($email) {
        $this->userEmail = $email;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getConsumerId() {
        return $this->consumerId;
    }

    public function setConsumerId($consumerId) {
        $this->consumerId = $consumerId;
    }

    public function getConsumerKey() {
        return $this->consumerKey;
    }

    public function setConsumerKey($consumerKey) {
        $this->consumerKey = $consumerKey;
    }

    public function getConsumerSecret() {
        return $this->consumerSecret;
    }

    public function setConsumerSecret($consumerSecret) {
        $this->consumerSecret = $consumerSecret;
    }

    public function getRequestToken() {
        return $this->requestToken;
    }

    public function setRequestToken($token) {
        $this->requestToken = $token;
    }
} 