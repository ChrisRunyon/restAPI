<?php

namespace Rest\Database;

use PDOException;

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/10/2015
 * Time: 2:33 PM
 */
class PDODBException extends PDOException {

    public function __construct(PDOException $e) {
        if(strstr($e->getMessage(), 'SQLSTATE[')) {
            preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);
            $this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
            $this->message = $matches[3];
        }
    }
}
