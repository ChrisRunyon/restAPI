<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/7/2015
 * Time: 5:59 PM
 */
class EntityManager
{

    protected $persist;
    protected $logger;
    protected $server;
    protected $token;

    public function __construct() {
    }

    public function getEntityPreflight() {
        return $this->persist;
    }

    public function setEntityPreflight($entity) {
        $reflect = new ReflectionClass(get_class($entity));
        $this->persist = array();
        foreach ($reflect->getProperties() as $property) {
            $property->setAccessible(true);
            $this->persist[$property->getName()] = $property->getValue($entity);
            $property->setAccessible(false);
        }
        return $this->persist;
    }

}
