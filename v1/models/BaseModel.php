<?php

class BaseModel extends ApiModel
{
    protected $sql;

    public function __construct() {}

    public function getModel($action)
    {
        switch($action)
        {
            case 'friends':
                $this->sql = 'SELECT * FROM actions';
                break;
            case 'enemies':
                $this->sql = 'SELECT * FROM uc_countries LIMIT 0, 30';
                break;
            default:
                $this->sql = 'SELECT * FROM actions LIMIT 0, 30';
                break;
        }
        return $this->sql;
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
*/
    public function postModel($data)
    {
        $sql = "INSERT INTO actions VALUES (".$data['name'].")";
        return $sql;
    }

    function i($table, $array)
    {
        $query = "INSERT INTO ".$table;
        $fis = array();
        $vas = array();
        foreach($array as $field=>$val)
        {
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

    public function insert($data)
    {
        $sql = "INSERT INTO clips (name, title, description, thumbnail, link, duration)
                VALUES (':name', ':title', ':description', ':thumbnail', ':link', ':duration')";
        $stmt = $this->connection->prepare($sql);
        if($stmt == false)
        {
            throw new Exception(print_r($stmt->errorInfo(),1).PHP_EOL.$sql);
        }
        foreach($array as $data)
        {
            $values = array(
                ':name'        => $data['title'],
                ':description' => $data['description'],
                ':thumbnail'   => $data['thumbnail'],
                ':link'        => $data['link'],
                ':duration'    => $data['duration']
            );
            if($stmt->execute($values) == false)
            {
                throw new Exception(print_r($stmt->errorInfo(),1).PHP_EOL.$sql);
            }
        }
    }
}
