<?php
/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/19/2015
 * Time: 3:23 PM
 */

class AccountEntity
{

    const INSERT_SQL = <<<EOF
INSERT INTO `accounts` (`business_address`, `business_logo`, `business_name`, `business_url`, `business_city`, `business_country`, `business_line_1`, `business_line_2`, `business_postal_code`, `business_state`, `business_support_phone`, `business_timezone`, `createdAtDate`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
EOF;

    protected $business_address;
    protected $business_logo;
    protected $business_name;
    protected $business_url;
    protected $business_city;
    protected $business_country;
    protected $business_line_1;
    protected $business_line_2;
    protected $business_postal_code;
    protected $business_state;
    protected $business_support_phone;
    protected $business_timezone;
    protected $createdAtDate;

    public function __construct() {}

    public function mapData($data) {
        $this->setBusinessAddress($data['business_address']);
        $this->setBusinessLogo($data['business_logo']);
        $this->setBusinessName($data['business_name']);
        $this->setBusinessUrl($data['business_url']);
        $this->setCity($data['business_city']);
        $this->setCountry($data['business_country']);
        $this->setLine1($data['business_address_line_1']);
        $this->setLine2($data['business_address_line_2']);
        $this->setPostalCode($data['business_postal_code']);
        $this->setState($data['business_state']);
        $this->setSupportPhone($data['business_support_phone']);
        $this->setTimezone($data['business_timezone']);
        $this->setCreatedAtDate();
    }

    public function getInsertSql() {
        return self::INSERT_SQL;
    }

    /**
     * @return mixed
     */
    public function getBusinessAddress()
    {
        return $this->business_address;
    }

    /**
     * @param mixed $business_address
     */
    public function setBusinessAddress($business_address)
    {
        $this->business_address = $business_address;
    }

    /**
     * @return mixed
     */
    public function getBusinessLogo()
    {
        return $this->business_logo;
    }

    /**
     * @param mixed $business_logo
     */
    public function setBusinessLogo($business_logo)
    {
        $this->business_logo = $business_logo;
    }

    /**
     * @return mixed
     */
    public function getBusinessName()
    {
        return $this->business_name;
    }

    /**
     * @param mixed $business_name
     */
    public function setBusinessName($business_name)
    {
        $this->business_name = $business_name;
    }

    /**
     * @return mixed
     */
    public function getBusinessUrl()
    {
        return $this->business_url;
    }

    /**
     * @param mixed $business_url
     */
    public function setBusinessUrl($business_url)
    {
        $this->business_url = $business_url;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->business_city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->business_city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->business_country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->business_country = $country;
    }

    /**
     * @return mixed
     */
    public function getLine1()
    {
        return $this->business_line_1;
    }

    /**
     * @param mixed $line1
     */
    public function setLine1($line1)
    {
        $this->business_line_1 = $line1;
    }

    /**
     * @return mixed
     */
    public function getLine2()
    {
        return $this->business_line_2;
    }

    /**
     * @param mixed $line2
     */
    public function setLine2($line2)
    {
        $this->business_line_2 = $line2;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->business_postal_code;
    }

    /**
     * @param mixed $postal_code
     */
    public function setPostalCode($postal_code)
    {
        $this->business_postal_code = $postal_code;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->business_state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->business_state = $state;
    }

    /**
     * @return mixed
     */
    public function getSupportPhone()
    {
        return $this->business_support_phone;
    }

    /**
     * @param mixed $support_phone
     */
    public function setSupportPhone($support_phone)
    {
        $this->business_support_phone = $support_phone;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->business_timezone;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->business_timezone = $timezone;
    }

    public function getCreatedAtDate() {
        return $this->createdAtDate;
    }

    public function setCreatedAtDate() {
        $this->createdAtDate = date("Y-m-d H:i:s");
    }
}
