<?php

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/12/2015
 * Time: 5:48 PM
 */
class StripeEntity
{

    const INSERT_SQL = <<<EOF
INSERT INTO `purchase_attempts` (`token`, `cardId`, `amount`, `buyerName`, `buyerEmail`, `buyerPhone`, `description`, `clientIp`, `createdAtDate`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
EOF;


    protected $token;
    protected $cardId;
    protected $buyerName;
    protected $buyerEmail;
    protected $description;
    protected $amount;
    protected $buyerPhone;
    protected $clientIp;
    protected $createdAtDate;

    public function __construct() {}

    public function mapData($data) {
        $this->setAmount($data['buy-amount']);
        $this->setName($data['card-holder-name']);
        $this->setEmail($data['card-holder-email']);
        $this->setPhone($data['card-holder-phone']);
        $this->setDescription($data['buy-description']);
        $this->setCardId($data['card-id']);
        $this->setClientIp($data['client-ip']);
        $this->setToken($data['stripeToken']);
        $this->setCreatedAtDate();
    }

    public function getInsertSql() {
        return self::INSERT_SQL;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function getCardId() {
        return $this->cardId;
    }

    public function setCardId($cardId) {
        $this->cardId = $cardId;
    }

    public function getName() {
        return $this->buyerName;
    }

    public function setName($name) {
        $this->buyerName = $name;
    }

    public function getEmail() {
        return $this->buyerEmail;
    }

    public function setEmail($email) {
        $this->buyerEmail = $email;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getPhone() {
        return $this->buyerPhone;
    }

    public function setPhone($phone) {
        $this->buyerPhone = $phone;
    }

    public function getClientIp() {
        return $this->clientIp;
    }

    public function setClientIp($clientIp) {
        $this->clientIp = $clientIp;
    }

    public function getCreatedAtDate() {
        return $this->createdAtDate;
    }

    public function setCreatedAtDate() {
        $this->createdAtDate = date("Y-m-d H:i:s");
    }
}
