<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/v1/entities/ForecastStatement.php');

class ForecastEntity extends ForecastStatement
{

    protected $ID;
    protected $CAMPUSCODE;
    protected $COHORT;
    protected $FTF_4YR_GOAL;
    protected $FTF_6YR_GOAL;
    protected $TR_2YR_GOAL;
    protected $TR_4YR_GOAL;
    protected $FTF_4YR_GRAD;
    protected $FTF_4YR_GRAD_LCL;
    protected $FTF_4YR_GRAD_UCL;
    protected $FTF_6YR_GRAD;
    protected $FTF_6YR_GRAD_LCL;
    protected $FTF_6YR_GRAD_UCL;
    protected $FTF_6YR_GRAD_PELL;
    protected $FTF_6YR_GRAD_LCL_PELL;
    protected $FTF_6YR_GRAD_UCL_PELL;
    protected $FTF_6YR_GRAD_NONPELL;
    protected $FTF_6YR_GRAD_LCL_NONPELL;
    protected $FTF_6YR_GRAD_UCL_NONPELL;
    protected $FTF_6YR_GRAD_URM;
    protected $FTF_6YR_GRAD_LCL_URM;
    protected $FTF_6YR_GRAD_UCL_URM;
    protected $FTF_6YR_GRAD_NONURM;
    protected $FTF_6YR_GRAD_LCL_NONURM;
    protected $FTF_6YR_GRAD_UCL_NONURM;
    protected $TR_2YR_GRAD;
    protected $TR_2YR_GRAD_LCL;
    protected $TR_2YR_GRAD_UCL;
    protected $TR_4YR_GRAD;
    protected $TR_4YR_GRAD_LCL;
    protected $TR_4YR_GRAD_UCL;
    protected $FTF_4YR_ACTUAL_FLAG;
    protected $FTF_6YR_ACTUAL_FLAG;
    protected $TR_2YR_ACTUAL_FLAG;
    protected $TR_4YR_ACTUAL_FLAG;
    protected $user_id;
    protected $CREATED;

    public function __construct() {}

    public function mapData($data) {
        $this->setCampusCode($data['campuscode']);
        $this->setCohort($data['cohort']);
        $this->setFTF4YRGoal($data['ftf_4yr_goal']);
        $this->setFTF6YRGoal($data['ftf_6yr_goal']);
        $this->setTR2YRGoal($data['tr_2yr_goal']);
        $this->setTR4YRGoal($data['tr_4yr_goal']);
        $this->setFTF4YRGrad($data['ftf_4yr_grad']);
        $this->setFTF4YRGradLCL($data['ftf_4yr_grad_lcl']);
        $this->setFTF4YRGradUCL($data['ftf_4yr_grad_ucl']);
        $this->setFTF6YRGrad($data['ftf_6yr_grad']);
        $this->setFTF6YRGradLCL($data['ftf_6yr_grad_lcl']);
        $this->setFTF6YRGradUCL($data['ftf_6yr_grad_ucl']);
        $this->setFTF6YRGradPell($data['ftf_6yr_grad_pell']);
        $this->setFTF6YRGradLCLPell($data['ftf_6yr_grad_lcl_pell']);
        $this->setFTF6YRGradUCLPell($data['ftf_6yr_grad_ucl_pell']);
        $this->setFTF6YRGradNonPell($data['ftf_6yr_grad_nonpell']);
        $this->setFTF6YRGradLCLNonPell($data['ftf_6yr_grad_lcl_nonpell']);
        $this->setFTF6YRGradUCLNonPell($data['ftf_6yr_grad_ucl_nonpell']);
        $this->setFTF6YRGradURM($data['ftf_6yr_grad_urm']);
        $this->setFTF6YRGradLCLURM($data['ftf_6yr_grad_lcl_urm']);
        $this->setFTF6YRGradUCLURM($data['ftf_6yr_grad_ucl_urm']);
        $this->setFTF6YRGradNonURM($data['ftf_6yr_grad_nonurm']);
        $this->setFTF6YRGradLCLNonURM($data['ftf_6yr_grad_lcl_nonurm']);
        $this->setFTF6YRGradUCLNonURM($data['ftf_6yr_grad_ucl_nonurm']);
        $this->setTR2YRGrad($data['tr_2yr_grad']);
        $this->setTR2YRGradLCL($data['tr_2yr_grad_lcl']);
        $this->setTR2YRGradUCL($data['tr_2yr_grad_url']);
        $this->setTR4YRGrad($data['tr_4yr_grad']);
        $this->setTR4YRGradLCL($data['tr_4yr_grad_lcl']);
        $this->setTR4YRGradUCL($data['tr_4yr_grad_ucl']);
        $this->setFTF4YRActualFlag($data['ftf_4yr_actual_flag']);
        $this->setFTF6YRActualFlag($data['ftf_6yr_actual_flag']);
        $this->setTR2YRActualFlag($data['tr_2yr_actual_flag']);
        $this->setTR4YRActualFlag($data['tr_4yr_actual_flag']);
        $this->setUserId($data['user_id']);
        $this->setCreatedAtDate();
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
    public function getCohort()
    {
        return $this->COHORT;
    }

    /**
     * @param mixed
     */
    public function setCohort($cohort)
    {
        $this->COHORT = $cohort;
    }

    /**
     * @return mixed
     */
    public function getFTF4YRGrad()
    {
        return $this->FTF4YRGRAD;
    }

    /**
     * @param mixed
     */
    public function setFTF4YRGrad($value)
    {
        $this->FTF4YRGRAD = $value;
    }

    /**
     * @return mixed
     */
    public function getFTF4YRGradLCL()
    {
        return $this->FTF_4YR_GRAD_LCL;
    }

    /**
     * @param mixed
     */
    public function setFTF4YRGradUCL($value)
    {
        $this->FTF_4YR_GRAD_UCL = $value;
    }

    /**
     * @return mixed
     */
    public function getFTF6YRGrad()
    {
        return $this->FTF_6YR_GRAD;
    }

    /**
     * @param mixed
     */
    public function setFTF6YRGrad($value)
    {
        $this->FTF_6YR_GRAD = $value;
    }

    /**
    * @param mixed
    */
    public function getFTF6YRGradLCL() 
    {
        return $this->FTF_6YR_GRAD_LCL;
    }

    /**
    * @param mixed
    */
    public function setFTF6YRGradLCL($value) 
    {
        $this->FTF_6YR_GRAD_LCL = $value;
    }

    /**
    * @param mixed
    */
    public function getFTF6YRGradUCL() 
    {
        return $this->FTF_6YR_GRAD_UCL;
    }

    /**
    * @param mixed
    */
    public function setFTF6YRGradUCL($value) 
    {
        $this->FTF_6YR_GRAD_UCL = $value;
    }
   
    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAtDate()
    {
        return $this->CREATED;
    }

    /**
     *
     */
    public function setCreatedAtDate()
    {
        $this->CREATED = date("Y-m-d H:i:s");
    }
}
