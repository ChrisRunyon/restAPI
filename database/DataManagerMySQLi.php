<?php

namespace Rest\Database;

use MySQLi;

require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

/*
 * Extends MySQLi
 * Don't extend this class directly
 * Use ApiModel.php to access this class
 */
class DataManagerMySQLi extends MySQLi
{

    protected $port = 3306;
    protected $host = '127.0.0.1';
    protected $user = 'root';
    protected $pwd = '';
    protected $dbName = 'rest';
    protected $conn;
    protected $result;
    protected $response;
    protected $row;
    protected $stmt;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        parent::init();
        $this->conn = parent::real_connect($this->host, $this->user, $this->pwd, $this->dbName);


        if (!$this->conn)
        {
            throw new Exception('Connect Error (' . mysqli_connect_error() . ')');
        }
    }

    /**
     *  Close database
     */
    public function close()
    {
        parent::close();
    }
}

