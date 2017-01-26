<?php

require_once(__DIR__ . '/ApiModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/entities/SeatingEntity.php');

class SeatingModel extends ApiModel
{

    protected $sql;
    protected $persist;
    protected $entity;
    protected $mapData;
    protected $response;

    public function getModel($action, $data = null) {
        $this->entity = new SeatingEntity();
        switch($action) {
            case 'all':
                $this->sql = $this->entity->getSelectAllSql();
                $this->response = $this->parseResponse($this->dm->prepareSelectAll($this->sql));
                break;
            case 'id':
                $this->command = 'SELECT sid, color, designation, date, price FROM "'. $this->table .'"  WHERE id = "' . $data['id'] . '"';

                break;
            default:
                break;
        }
        return $this->response;
    }

    public function postModel($action, $data = null) {
        switch($action) {
            case 'create':
                $this->command = 'INSERT INTO theatre (sid, color, designation, date, price) VALUES ("'.$data['name'].'")';

                break;
            default:
                break;
        }
        return $this->command;
    }

    public function updateModel() {

    }


    /*
    public function postModel($data) {
        $sql = "INSERT INTO clips (name, title, description, thumbnail, link, duration)
                VALUES (':name', ':title', ':description', ':thumbnail', ':link', ':duration')";
        $stmt = $this->connection->prepare($sql);
        if($stmt == false) {
            echo "fasle";
            throw new Exception(print_r($stmt->errorInfo(),1).PHP_EOL.$sql);
        }
        foreach($array as $data) {
            $values = array(
                ':name'        => $data['title'],
                ':description' => $data['description'],
                ':thumbnail'   => $data['thumbnail'],
                ':link'        => $data['link'],
                ':duration'    => $data['duration']
            );
            if($stmt->execute($values) == false) {
                echo "false";
                throw new Exception(print_r($stmt->errorInfo(),1).PHP_EOL.$sql);
            }
        }
    }

    function i($table, $array) {
        $query = "INSERT INTO ".$table;
        $fis = array();
        $vas = array();
        foreach($array as $field=>$val) {
            $fis[] = "`$field`"; //you must verify keys of array outside of function;
                                 //unknown keys will cause mysql errors;
                                 //there is also sql injection risc;
            $vas[] = "'".mysql_real_escape_string($val)."'";
        }
        $query .= " (".implode(", ", $fis).") VALUES (".implode(", ", $vas).")";
        if (mysql_query($query))
            return mysql_insert_id();
        else return false;
    }

    public function insert($data) {
        $sql = "INSERT INTO clips (name, title, description, thumbnail, link, duration)
                VALUES (':name', ':title', ':description', ':thumbnail', ':link', ':duration')";
        $stmt = $this->connection->prepare($sql);
        if($stmt == false) {
            throw new Exception(print_r($stmt->errorInfo(),1).PHP_EOL.$sql);
        }
        foreach($array as $data) {
            $values = array(
                ':name'        => $data['title'],
                ':description' => $data['description'],
                ':thumbnail'   => $data['thumbnail'],
                ':link'        => $data['link'],
                ':duration'    => $data['duration']
            );
            if($stmt->execute($values) == false) {
                throw new Exception(print_r($stmt->errorInfo(),1).PHP_EOL.$sql);
            }
        }
    }
    */
}
