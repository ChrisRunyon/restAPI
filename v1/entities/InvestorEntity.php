<?php
/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/26/2015
 * Time: 12:31 AM
 */

class InvestorEntity {

    protected $salutation;
    protected $name;
    protected $email;
    protected $referral;
    protected $message;
    protected $sendMail;
    protected $sendCopy;
    protected $createdAtDate;

    public function __construct() {}

    public function mapData($data) {
        $this->setEmail($data['email']);
        $this->setMessage($data['message']);
        $this->setName($data['name']);
        $this->setReferral($data['referral']);
        $this->setSalutation($data['salutation']);
        $this->setSendCopy($data['send_copy']);
        $this->setSendMail($data['send_mail']);
        $this->setCreatedAtDate();
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getReferral()
    {
        return $this->referral;
    }

    /**
     * @param mixed $referral
     */
    public function setReferral($referral)
    {
        $this->referral = $referral;
    }

    /**
     * @return mixed
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param mixed $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
    }

    /**
     * @return mixed
     */
    public function getSendCopy()
    {
        return $this->sendCopy;
    }

    /**
     * @param mixed $sendCopy
     */
    public function setSendCopy($sendCopy)
    {
        $this->sendCopy = $sendCopy;
    }

    /**
     * @return mixed
     */
    public function getSendMail()
    {
        return $this->sendMail;
    }

    /**
     * @param mixed $sendMail
     */
    public function setSendMail($sendMail)
    {
        $this->sendMail = $sendMail;
    }

    public function getCreatedAtDate() {
        return $this->createdAtDate;
    }

    public function setCreatedAtDate() {
        $this->createdAtDate =  date("Y-m-d H:i:s");
    }
}
