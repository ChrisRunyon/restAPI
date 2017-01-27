<?php

//DO NOT USE
//Vulnerable to SQLInjection hacks
class SubsitesModel extends ApiModel
{

    protected $sql;

    public function __construct() {}

    public function getModel($subsite) {
        if($subsite == 'musics') {
            $this->sql = 'SELECT * FROM '. $subsite . ' ORDER BY vid DESC limit 45';
        } else {
            $this->sql = 'SELECT * FROM '. $subsite . ' ORDER BY vid DESC';
        }
        return $this->sql;
    }

    public function getAds($subsite) {
        $this->sql = 'SELECT * FROM ad_tags WHERE domain = ' . '"'.$subsite.'"';
        return $this->sql;
    }

    public function postModel($subsite) {
        $video = $_POST['video_file'];
        $image = $_POST['image_file'];
        $title = str_replace("'", "\'", $_POST['title']);
        $description = str_replace("'", "\'", $_POST['description']);
        $link = str_replace("'", "\'", $_POST['link']);
        $duaration = 3600 * ($_POST['h']) + 60 * ($_POST['m']) + ($_POST['s']);
        $sql = "INSERT INTO ". $subsite . " (title, description, duration, link, video_file, image_file, uploaded_by) VALUES ('".$title."','".$description."',$duaration,'".$link."','".$video."','".$image."','".$_POST['user']."')";
        return $sql;
    }

    public function createAd($subsite) {
        $domain = str_replace("'", "\'", $_POST['domain']);
        $video = str_replace("'", "\'", $_POST['video']);
        $leaderboard = str_replace("'", "\'", $_POST['leaderboard']);
        $skyscraper = str_replace("'", "\'", $_POST['skyscraper']);
        $medrec = str_replace("'", "\'", $_POST['medrec']);
        $sql = "INSERT INTO ad_tags (domain, Video, Leaderboard, SkyScraper, MedRec, modified_by) VALUES ('".$domain."','".$video."','".$leaderboard."','".$skyscraper."','".$medrec."','".$_POST['user']."')";
        echo $sql;
        return $sql;
    }

    // only for video tags, display tags are not updated in restful api
    public function editAd($subsite) {
        $domain = str_replace("'", "\'", $_POST['domain']);
        $video = str_replace("'", "\'", $_POST['Video']);
        $sql = "UPDATE ad_tags SET Video = '".$video."' WHERE domain = '".$subsite."'";
        echo $sql;
        return $sql;
    }

    public function getTag($subsite, $tag) {
        switch($tag) {
        case 'all':
            $sql = "SELECT * FROM ad_tags WHERE domain = '".$subsite."'";
            break;
        default:
            $sql = "SELECT ".$tag." FROM ad_tags WHERE domain = '".$subsite."'";
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

    function fakePath($str) {
        return substr($str, 11, strlen($str)-11);
    }
}

