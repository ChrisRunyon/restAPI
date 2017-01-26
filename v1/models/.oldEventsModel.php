<?php

class EventsModelOld extends ApiModel {
    protected $sql;

    public function __construct() {}

    public function getModel($event) {
        if(isset($event)) {
            switch($event) {
                case 'live':
                    $this->sql = "select * from events where time < NOW() and end > NOW()";
                    break;
                case 'coming':
                    $this->sql = "select * from events where time > NOW()";
                    break;
                case 'recording':
                    $this->sql = "select * from events where eid = ".$event;
                    break;
                default:
                    $this->sql = "select * from events";
                    break;
            }
        }
        return $this->sql;
    }

    public function searchByDate($date) {
        $this->sql = 'select * from events where DATE(time) = "'.$date.'"';
        return $this->sql;
    }

    public function postModel($action) {
        $start = $this->getStart();
        $end = $this->getEnd();
        $venue = str_replace("'", "\'", $_POST['venue']);
        $performers = str_replace("'", "\'", $_POST['performers']);
        $link = str_replace("'", "\'", $_POST['link']);
        if($action == 'null') {
            $sql = "INSERT INTO events (venue, performers, time, end, link) VALUES ('".$venue."','".$performers."','".$start."','".$end."','".$link."')";
        } else {
            $sql = "update events set venue = '".$venue."', performers = '".$performers."', link = '".$link."';";
        }
        return $sql;
    }

    public function appendZero($str)
    {
        if(strlen($str) == 1)
        {
            $str = '0'.$str;
        }
        return $str;
    }
    public function getStart()
    {
        $date = $_POST['date'];
        $sh = $this->appendZero($_POST['sh']);
        $sm = $this->appendZero($_POST['sm']);
        $formatted = substr($date, 6, 4)."-".substr($date, 0, 2)."-".substr($date, 3, 2)." ".$sh.":".$sm.":"."00";
        return $formatted;
    }

    public function getEnd()
    {
        $date = $_POST['end_date'];
        $eh = $this->appendZero($_POST['eh']);
        $em = $this->appendZero($_POST['em']);
        $formatted = substr($date, 6, 4)."-".substr($date, 0, 2)."-".substr($date, 3, 2)." ".$eh.":".$em.":"."00";
        return $formatted;
    }
}

