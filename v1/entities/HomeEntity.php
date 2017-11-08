<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/HomeStatement.php');

class HomeEntity extends HomeStatement
{

    protected $CAMPUSCODE;
    protected $FTF_4YR_COLOR;
    protected $FTF_6YR_COLOR;
    protected $TR_2YR_COLOR;
    protected $TR_4YR_COLOR;
    protected $PELL_6YR_COLOR;
    protected $URM_6YR_COLOR;

    public function __construct() {}

    public function mapData($data) {
        $this->setCampusCode($data['campuscode']);
        $this->setFTF4YRColor($data['ftf_4yr_color']);
        $this->setFTF6YRColor($data['ftf_6yr_color']);
        $this->setTR2YRColor($data['tr_2yr_color']);
        $this->setTR4YRColor($data['tr_4yr_color']);
        $this->setPell6YRColor($data['pell_6yr_color']);
        $this->setURM6YRColor($data['urm_6yr_color']);
    }

    /**
     * @return mixed
     */
    public function getCampusCode()
    {
        return $this->CAMPUSCODE;
    }

    /**
     * @param mixed
     */
    public function setCampusCode($campuscode)
    {
        $this->CAMPUSCODE = $campuscode;
    }

    /**
     * @return mixed
     */
    public function getFTF4YRColor()
    {
        return $this->FTF_4YR_COLOR;
    }

    /**
     * @param mixed
     */
    public function setFTF4YRColor($value)
    {
        $this->FTF_4YR_COLOR = $value;
    }

    /**
     * @return mixed
     */
    public function getFTF6YRColor()
    {
        return $this->FTF_6YR_COLOR;
    }

    /**
     * @param mixed
     */
    public function setFTF6YRColor($value)
    {
        $this->FTF_6YR_COLOR = $value;
    }
}
