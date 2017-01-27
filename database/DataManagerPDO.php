<?php

namespace Rest\Database;

use PDO;

require_once(__DIR__ . '/PDODBException.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');


/*
 * Extends PDO
 * Don't extend this class directly
 * Use ApiModel.php to access this class
 */
class DataManagerPDO extends PDO
{
    protected $driver;
    protected $dsn;
    protected $user;
    protected $password;
    protected $options;
    protected $attributes;
    protected $stmt;

    public function __construct()
    {
        $ini = __DIR__ . "../../config/config.ini" ;
        $parse = parse_ini_file ( $ini , true ) ;

        $driver = $parse [ "db_driver" ] ;
        $dsn = "${driver}:" ;
        $user = $parse [ "db_user" ] ;
        $password = $parse [ "db_password" ] ;
        $options = $parse [ "db_options" ] ;
        $attributes = $parse [ "db_attributes" ] ;

        foreach ( $parse [ "dsn" ] as $k => $v ) {
            $dsn .= "${k}=${v};" ;
        }

        try {
            parent:: __construct($dsn, $user, $password, $options);

            foreach ($attributes as $k => $v) {
                parent:: setAttribute(constant("PDO::{$k}")
                    , constant("PDO::{$v}"));
            }
        } catch(PDODBException $e) {
            throw new PDODBException($e);
        }
    }

    /**
     * @param $sql
     * @param $data
     * @return mixed
     */
    public function prepSelect($sql, $data) {
        parent::beginTransaction();
        $this->stmt = $this->prepare($sql);

        if(false===$this->stmt) {
        }

        $q = $this->stmt->execute($this->buildParams($data));
        if(false===$q) {
            return false;
        }
        parent::commit();

        $result = $this->stmt->fetch();

        return $result;
    }

    /**
     * @param $sql
     * @param $data
     * @return mixed
     */
    public function prepSelectByURL($sql, $data) {
        parent::beginTransaction();
        $this->stmt = $this->prepare($sql);

        if(false===$this->stmt) {
        }

        $arr = array(
            'modelName' => $data
        );
        $q = $this->stmt->execute($this->buildParams($arr));
        if(false===$q) {
            return false;
        }
        parent::commit();

        $result = $this->stmt->fetch();
        $decode = $this->rawurldecode_array($result);

        return $decode;
    }

    /**
     * @param $sql
     * @param $data
     * @return mixed
     */
    public function prepSelectByUserId($sql, $data) {
        parent::beginTransaction();
        $this->stmt = $this->prepare($sql);

        if(false===$this->stmt) {
        }

        $arr = array(
            'user_id' => $data
        );
        $q = $this->stmt->execute($this->buildParams($arr));
        if(false===$q) {
            return false;
        }
        parent::commit();

        $values = $this->stmt->fetchAll();
        $decode = $this->rawurldecode_array($values);

        $keys = array_keys($decode);
        $last = count($decode[$keys[0]]);
        $data = [];
        for($i = 0; $i < $last; $i++) {
            foreach ($decode as $key => $value) {
                $data['result'][$key] = $value;
            }
        }
        return $data;
    }

    /**
     * @param $sql
     * @param $data
     * @return mixed
     */
    public function prepSelectById($sql, $data) {
        parent::beginTransaction();
        $this->stmt = $this->prepare($sql);

        if(false===$this->stmt) {
        }

        $arr = array(
            'user_id' => $data
        );
        $q = $this->stmt->execute($this->buildParams($arr));
        if(false===$q) {
            return false;
        }
        parent::commit();

        $values = $this->stmt->fetch();
        $decode = $this->rawurldecode_array($values);

        return $decode;
    }

    /**
     * @param $sql
     * @return array
     */
    public function prepSelectAll($sql) {
        parent::beginTransaction();
        $this->stmt = $this->prepare($sql);

        if(false===$this->stmt) {
        }
        $q = $this->stmt->execute();

        if(false===$q) {
        }
        parent::commit();

        $values = $this->stmt->fetchAll();
        $decode = $this->rawurldecode_array($values);

        $keys = array_keys($decode);
        if(count($keys)) {
            $last = count($decode[$keys[0]]);
            $data = [];
            for ($i = 0; $i < $last; $i++) {
                foreach ($decode as $key => $value) {
                    $data['result'][$key] = $value;
                }
            }
        } else {
            $data['result'] = 'no results found';
        }

        return $data;
    }

    public function prepInsert($sql, $data) {
        parent::beginTransaction();
        $preFlight = $this->buildParams($data);
        $this->stmt = $this->prepare($sql);

        if(false===$this->stmt) {
        }
        $q = $this->stmt->execute($preFlight);

        if(false===$q) {
        }
        parent::commit();

        return $preFlight;
    }

    public function prepUpdate($sql, $data) {
        parent::beginTransaction();
        $this->stmt = $this->prepare($sql);
        $modelName = $data['modelName'];
        $modelDescription = $data['modelDescription'];
        $modelImageFile = $data['modelImageFile'];
        $modelId = $data['modelId'];

        //bindParams didn't work because array was out of order?
        //used bindValue instead to workaround
        //look into array index ordering later
        $this->stmt->bindValue(':modelName', $modelName);
        $this->stmt->bindValue(':modelDescription', $modelDescription);
        $this->stmt->bindValue(':modelImageFile', $modelImageFile);
        $this->stmt->bindValue(':modelId', $modelId);

        if(false===$this->stmt) {
            echo 'statement is false';
        }
        $q = $this->stmt->execute();

        if(false===$q) {
            echo 'statement failed to execute';
        }
        parent::commit();
        return "success";
    }

    /**
     * Insert multiple arrays of data in one query
     *
     * @param $dataFields
     * @param $data
     */
    public function prepMultiInsert($dataFields, $data) {
        parent::beginTransaction(); // also helps speed up your inserts.
        $insert_values = array();
        foreach($data as $d){
            $question_marks[] = '('  . $this->placeholders('?', sizeof($d)) . ')';
            $insert_values = array_merge($insert_values, array_values($d));
        }

        $sql = "INSERT INTO event_seats (" . implode(",", $dataFields ) . ") VALUES " . implode(',', $question_marks);

        $stmt = parent::prepare ($sql);
        try {
            $stmt->execute($insert_values);
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        parent::commit();
    }

    public function buildParams($params) {
        // build params
        if( is_null($params) OR !is_array($params) OR count($params) == 0) {
           // $whereClause = '';
        } else {
           // $whereClause = array();
            foreach ($params as $key => $value){
                $bind_name    = 'bind_'.$key; //generate a name for bind1, bind2, bind3...
                $$bind_name   = $value; //create a variable with this name with value in it
                $bind_names[] = & $$bind_name; //put a link to this variable in array
                //$whereClause[] = "'$key' = :$bind_name";
            }
            //$whereClause = count($whereClause) > 0 ? ' WHERE '.implode( ' AND ' , $whereClause ) : '';
        }

        return $bind_names;
    }

    private function rawurldecode_array(&$arr)
    {
        foreach (array_keys($arr) as $key)
        {
            if (is_array($arr[$key]))
            {
                $this->rawurldecode_array($arr[$key]);
            }
            else
            {
                $arr[$key] = rawurldecode($arr[$key]);
            }
        }

        $striped = $this->stripslashes_array($arr);

        return $striped;
    }

    private function stripslashes_array(&$arr) {
        foreach ($arr as $k => &$v) {
            $nk = stripslashes($k);
            if ($nk != $k) {
                $arr[$nk] = &$v;
                unset($arr[$k]);
            }
            if (is_array($v)) {
                $this->stripslashes_array($v);
            } else {
                $arr[$nk] = stripslashes($v);
            }
        }

        return $arr;
    }

    private function placeholders($text, $count=0, $separator=",") {
        $result = array();
        if($count > 0){
            for($x=0; $x<$count; $x++){
                $result[] = $text;
            }
        }

        return implode($separator, $result);
    }
}
