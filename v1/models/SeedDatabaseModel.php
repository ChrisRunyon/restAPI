<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/utilities/Guid.php');

class SeedDatabaseModel extends ApiModel
{
    protected $sql;
    protected $data;
    protected $entity;
    protected $mapData;
    protected $response;
    protected $user_verify;

    public function getModel() {
        $createId = new Guid();
        $guId = $createId->guid();
        $data = [];
        $dataFields = array('createdAtDate', 'eventDate', 'eventTime');

        for($i = 0; $i < 1131; $i++) {
            $tmp = array('createdAtDate' => new date("Y-m-d H:i:s"), 'eventDate' => new date("Y-m-d"), 'eventTime' => new date("H:i:s"));
            array_push($data, $tmp);
        }

        $this->dataManager->prepMultiInsert($dataFields, $data);
        $this->response = "database seeded";

        return $this->response;
    }


    /**
     * @return string
     */
    public function postModel() {

        $createId = new Guid();
        $guId = $createId->guid();
        $data = [];
        $dataFields = array('event_id', 'createdAtDate', 'eventDate', 'eventTime');

        for($i = 0; $i < 1131; $i++) {
            $tmp = array('event_id' => '$guId', 'createdAtDate' => 'date("Y-m-d H:i:s")', 'eventDate' => 'date("Y-m-d")', 'eventTime' => 'date("H:i:s")');
            array_push($data, $tmp);
        }

        $this->dataManager->prepMultiInsert($dataFields, $data);
        $this->response = "database seeded";

        return $this->response;
    }
}
