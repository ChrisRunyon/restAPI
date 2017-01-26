<?php

class PasswdMgrModel extends ApiModel
{
    protected $sql;

    public function __construct() {}

    public function getModel($rowId, $action) {
        switch($action) {
            case 'all':
                $this->sql = 'SELECT * FROM passwdmgr';
                break;
            case 'edit':
                //TODO: add button to edit user from backbone list
                $this->sql = 'SELECT company, description, website, username, password FROM passwdmgr WHERE id = ' . '"' . $rowId . '"';
                break;
            default:
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
                ':description' => $data['description'],.0
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
    public function postModel($action, $data) {
        switch($action) {
            case 'create':
                $company = $_POST['company'];
                $description = $_POST['description'];
                $website = $_POST['website'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $sql = "INSERT INTO passwdmgr (company, description, website, username, password)
                        VALUES ('".$company."','".$description."','".$website."','".$username."','".$password."')";
                break;
            case 'edit':
                $rowid = $data;
                $company = $_POST['company'];
                $description = $_POST['description'];
                $website = $_POST['website'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $sql = "INSERT INTO passwdmgr SET id='".$rowid."', company='".$company."', description='".$description."',
                        website='".$website."', username='".$username."', password='".$password."' ON DUPLICATE KEY UPDATE
                        company='".$company."', description='".$description."',
                        website='".$website."', username='".$username."', password='".$password."'";
                break;
            default:
                break;
        }
        return $sql;
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
}
