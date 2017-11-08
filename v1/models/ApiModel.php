<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/database/DataManagerPDO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/entities/EntityManager.php');

abstract class ApiModel {
    protected $database;
    protected $dataManager;
    protected $entityManager;

    public function __construct() {
        $this->dataManager = new \Rest\Database\DataManagerPDO();
        $this->entityManager = new EntityManager();
    }

    public function optionsAction() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Max-Age: 1000");
        header("Access-Control-Allow-Headers: x-csrf-token, x-requested-with, Content-Type, origin, authorization, Accept, oauth_consumer_key,oauth_nonce,oauth_signature,oauth_signature_method,oauth_timestamp,oauth_token,oauth_version");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    }

    /**
     * @return DataManager
     */
    public function getConnection() {
        return $this->dataManager;
    }

    /**
     * Close Connection
     */
    public function closeConnection() {
        $this->$database->close();
    }

    public function parseResponse($response) {
        $keys = array_keys($response);
        $last = count($response[$keys[0]]);
        for($i = 0; $i < $last; $i++) {
            foreach ($response as $key => $value) {
                $data['result'][$key] = $value;
            }
        }

        return $data;
    }
}
