<?php

class VideosModel extends ApiModel
{
    protected $sql;

    public function __construct() {}

    public function getModel($action) {
        switch($action) {
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

    public function postModel($data) {
        echo $_COOKIE['user'];
        $video = $this->fakePath($data['video_file']);
        $image = $this->fakePath($data['image_file']);
        echo $video;
        echo $image;
        $sql = "INSERT INTO videos(title, description, duaration, link, video_file, image_file, uploaded_by) VALUES ('".$data["title"]."','".$data["description"]."','".$data["duaration"]."','".$data["link"]."','".$video."','".$image."','".$_COOKIE['user']."')";
        echo $sql;
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
    function fakePath($str) {
        return substr($str, 11, strlen($str)-11);
    }
}
