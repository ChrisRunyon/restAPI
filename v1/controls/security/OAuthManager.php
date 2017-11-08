<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/database/DataManagerMySQLi.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthStore.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthRequestLogger.php');


use OAuth1\OAuthRequestLogger;
use Rest\Database\DataManagerMySQLi;

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/31/2015
 * Time: 9:15 AM
 */
class OAuthManager
{
    public $store;
    protected $signature_method = "HMAC-SHA1";
    protected $version = "1.0";
    protected $user_id;
    protected $consumer;
    protected $consumer_id;
    protected $consumer_key;
    protected $consumer_secret;
    protected $server;
    protected $serverList;
    protected $options;
    protected $key;
    protected $identity;
    protected $token;
    protected $access;
    protected $config;
    protected $db;
    protected $oauthEntity;
    protected $oauthIdentity;
    protected $oauthRequestToken;
    protected $oauthRequestSecret;
    protected $oauthAccessToken;
    protected $oauthAccessSecret;
    protected $signature;

    public function __construct() {
        $oauth_ini = __DIR__ . "../../../../config/oauth.ini";
        $this->oauth_config =  parse_ini_file ( $oauth_ini , true );

        $this->db = new DataManagerMySQLi();
        $options = [
            'conn' => $this->db
        ];

        try {
            $this->store = \OAuth1\OAuthStore::instance('MySQLi', $options);
        } catch(Exception $e) {
            throw new Exception($e);
        }
    }

    public function attachOAuthEntity($entity) {
        if(!empty($entity)) {
            $this->oauthEntity = $entity;
        }
    }

    public function getOAuthEntity() {
        return $this->oauthEntity;
    }

    /**
     * @return mixed
     */
    public function getOAuthUserId() {
        return $this->oauthEntity->getUserId();
    }

    public function getOAuthEmail() {
        return $this->oauthEntity->getUserEmail();
    }

    public function getOAuthUserName() {
        return $this->oauthEntity->getUserName();
    }

    public function getOAuthConsumer() {
        return $this->consumer;
    }

    public function getOAuthServer() {
        return $this->server;
    }

    public function getOAuthIdentity() {
        return $this->oauthIdentity;
    }

    public function getOAuthConsumerId() {
        return $this->consumer_id;
    }

    public function getOAuthConsumerKey() {
        return $this->consumer_key;
    }

    public function getOAuthConsumerSecret() {
        return $this->consumer_secret;
    }

    public function getOAuthRequestToken() {
        return $this->oauthRequestToken;
    }

    public function getOAuthRequestSecret() {
        return $this->oauthRequestSecret;
    }

    public function getOAuthAccessToken() {
        return $this->oauthAccessToken;
    }

    public function getOAuthAccessSecret() {
        return $this->oauthAccessSecret;
    }

    public function getOAuthSignature() {
        return $this->signature;
    }

    public function getOAuthSignatureMethod() {
        return $this->signature_method;
    }

    public function setOAuthSignatureMethod($method) {
        $this->signature_method = $method;
    }

    public function getOAuthVersion() {
        return $this->version;
    }

    public function setOAuthVersion($version) {
        $this->version = $version;
    }

    public function setOAuthSignature($signature) {
        $this->signature = $signature;
    }

    public function setOAuthAccessToken($token) {
        $this->oauthAccessToken = $token;
    }

    public function setOAuthAccessSecret($secret) {
        $this->oauthAccessSecret = $secret;
    }

    public function setOAuthRequestToken($token) {
        $this->oauthRequestToken = $token;
    }

    public function setOAuthRequestSecret($secret) {
        $this->oauthRequestSecret = $secret;
    }

    public function setOAuthIdentity($identity) {
        $this->oauthIdentity = $identity;
    }

    public function setOAuthConsumerId($consumerId) {
        $this->consumer_id = $consumerId;
    }

    public function setOAuthConsumerKey($consumerKey) {
        $this->consumer_key = $consumerKey;
    }

    public function setOAuthConsumerSecret($consumerSecret) {
        $this->consumer_secret = $consumerSecret;
    }

    public function setOAuthServer() {
        $this->server = [
            'consumer_key' => $this->getOAuthConsumerKey(),
            'consumer_secret' => $this->getOAuthConsumerSecret(),
            'server_uri' => $this->oauth_config['oauth_server_uri'],
            'signature_methods' => array('HMAC-SHA1', 'PLAINTEXT'),
            'request_token_uri' => $this->oauth_config['oauth_request_token_uri'],
            'authorize_uri' => $this->oauth_config['oauth_authorize_token_uri'],
            'access_token_uri' => $this->oauth_config['oauth_access_token_uri']
        ];
    }

    public function setOAuthConsumer() {
        $this->consumer = [
            //required
            'requester_name' => $this->getOAuthUserName(),
            'requester_email' => $this->getOAuthEmail(),
            'user_id' => $this->getOAuthUserId(),
            //optional
            'callback_uri' => $this->oauth_config['oauth_callback_uri'],
            'application_uri' => $this->oauth_config['oauth_application_uri'],
            'application_title' => $this->oauth_config['oauth_application_title'],
            'application_descr' => $this->oauth_config['oauth_application_descr'],
            'application_notes' => $this->oauth_config['oauth_application_notes'],
            'application_type' => $this->oauth_config['oauth_application_type'],
            'application_commercial' => $this->oauth_config['oauth_application_commercial']
        ];
    }

    public function registerOAuthServer() {
        $this->store->updateServer($this->getOAuthServer(), $this->getOAuthUserId());
    }

    /* TODO: clean up UserController */
    public function registerOAuthConsumer() {
        $this->key = $this->store->updateConsumer($this->getOAuthConsumer(), $this->getOAuthUserId(), true);
        $this->identity = $this->store->getConsumer($this->key, $this->getOAuthUserId());
        $this->setOAuthIdentity($this->identity);
        $this->setOAuthConsumerId($this->identity['id']);
        $this->setOAuthConsumerKey($this->identity['consumer_key']);
        $this->setOAuthConsumerSecret($this->identity['consumer_secret']);
    }

    public function requestOAuthRequestToken() {
        $options = [
            'user_id' => $this->getOAuthUserId()
        ];
        OAuthRequestLogger::start();
        $this->token = $this->store->addConsumerRequestToken($this->getOAuthConsumerKey(), $options);
        $this->store->addServerToken($this->getOAuthConsumerKey(), 'request', $this->token['token'], $this->token['token_secret'], $this->getOAuthUserId(), []);
        $this->setOAuthRequestToken($this->token['token']);
        $this->setOAuthRequestSecret($this->token['token_secret']);
        OAuthRequestLogger::flush();

        return $this->token;
    }

    public function requestOAuthAccessToken() {
        OAuthRequestLogger::start();

        $this->store->authorizeConsumerRequestToken($this->getOAuthRequestToken(), $this->getOAuthUserId());
        $this->access  = $this->store->exchangeConsumerRequestForAccessToken($this->getOAuthRequestToken());
        $this->store->addServerToken($this->getOAuthConsumerKey(), 'access', $this->access['token'], $this->access['token_secret'], $this->getOAuthUserId(), []);
        $this->setOAuthAccessToken($this->access['token']);
        $this->setOAuthAccessSecret($this->access['token_secret']);
        OAuthRequestLogger::flush();

        return $this->access;
    }

    public function generateOAuthSignature() {
        // rawurlencode for percent encoding
        $base = rawurlencode("POSThttps://rest.com");
        $sign = urlencode($this->getOAuthConsumerSecret()).'&'.urlencode($this->getOAuthAccessSecret());
        $signature = base64_encode(hash_hmac("sha1", $base, $sign, true));
        $this->setOAuthSignature($signature);
    }

    public function buildOAuthParams() {
        $auth = [
            'username' => $this->oauthEntity->getUserName(),
            'oauth_consumer_key' => $this->getOAuthConsumerKey(),
            'oauth_signature' => $this->getOAuthSignature(),
            'oauth_signature_method' => $this->getOAuthSignatureMethod(),
            'oauth_token' => $this->getOAuthAccessToken(),
            'oauth_version' => $this->getOAuthVersion()
        ];

        return $auth;
    }

    public function listOAuthServers($user_id) {
        $this->serverList = $this->store->listServers($user_id);
    }

    public function deleteOAuthServer($consumer_key, $user_id) {
        $this->store->deleteServer($consumer_key, $user_id);
    }
}

