<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/12/2015
 * Time: 5:31 PM
 */
class StripeManager
{

    protected $success;
    protected $error;
    protected $token;
    protected $amount;
    protected $description;
    protected $entity;
    protected $customer;
    protected $name;
    protected $email;
    protected $managedAccount;

    public function __construct($stripeEntity)
    {
        $this->setEntity($stripeEntity);

        $ini = $_SERVER['DOCUMENT_ROOT'] . "/config/stripe.ini";
        $parse = parse_ini_file($ini, true);

        $apiKey = $parse ["api_key"];
        \Stripe\Stripe::setApiKey($apiKey);
    }

    public function createCustomer() {
        // Create a Customer
        $this->customer = \Stripe\Customer::create(array(
                "source" => $this->getToken(),
                "description" => '{name: '.$this->getName().', email: '.$this->getEmail().'}'
        ));
    }

    public function createCharge() {
        try {
            if (!$this->getToken())

            \Stripe\Charge::create(array(
                "amount" => $this->getAmount(),
                "currency" => "usd",
                "card" => $this->getToken(),
                "description" => $this->getDescription(),
                "customer" => $this->getCustomerId(),
                "application_fee" => 100 // amount in cents
            ));
            $this->success = 'Your payment was successful.';
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network problem, perhaps try again.
        } catch (\Stripe\Error\InvalidRequest $e) {
            // You screwed up in your programming. Shouldn't happen!
        } catch (\Stripe\Error\Api $e) {
            // Stripe's servers are down!
        } catch (\Stripe\Error\Card $e) {
            // Card was declined.
        }
    }

    public function createStripeManagedAccount() {
        $this->managedAccount = \Stripe\Account::create(
            array(
                "country" => "US",
                "managed" => true
            )
        );

        return $this->managedAccount;
    }

    public function mapData($data) {
        $this->setToken($data['stripeToken']);
        $this->setAmount($data['buy-amount']);
        $this->setDescription($data['buy-description']);
        $this->setName($data['card-holder-name']);
        $this->setEmail($data['card-holder-email']);
    }

    public function getEntity() {
        return $this->entity;
    }

    public function setEntity($entity) {
        $this->entity = $entity;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    /* TODO: Save this to DB maybe a customer table */
    public function getCustomerId() {
        return $this->customer->id;
    }
}

