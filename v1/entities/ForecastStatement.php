<?php

class ForecastStatement
{

    const SELECT_BY_CAMPUS = <<<EOF
SELECT * 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_TR_2YR = <<<EOF
SELECT CAMPUS_CODE, COHORT, NULL_FLAG_2YR_GOALS, TR_2YR_GOAL, TR_2YR_GRAD, TR_2YR_GRAD_LCL, TR_2YR_GRAD_UCL, TR_2YR_ACTUAL_FLAG, TR_2YR_GRAD_TOTAL, TR_2YR_GRAD_DIFF, TR_2YR_SUMMARY1, TR_2YR_SUMMARY2, TR_2YR_SUMMARY3
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_TR_4YR = <<<EOF
SELECT CAMPUS_CODE, COHORT, NULL_FLAG_4YR_GOALS, TR_4YR_GOAL, TR_4YR_GRAD, TR_4YR_GRAD_LCL, TR_4YR_GRAD_UCL, TR_4YR_ACTUAL_FLAG, TR_4YR_GRAD_TOTAL, TR_4YR_GRAD_DIFF, TR_4YR_SUMMARY1, TR_4YR_SUMMARY2, TR_4YR_SUMMARY3
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_4YR = <<<EOF
SELECT CAMPUS_CODE, COHORT, NULL_FLAG_4YR_GOALS, FTF_4YR_GOAL, FTF_4YR_GRAD, FTF_4YR_GRAD_LCL, FTF_4YR_GRAD_UCL, FTF_4YR_ACTUAL_FLAG, FTF_4YR_GRAD_TOTAL, FTF_4YR_GRAD_DIFF, FTF_4YR_SUMMARY1, FTF_4YR_SUMMARY2, FTF_4YR_SUMMARY3 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_6YR = <<<EOF
SELECT CAMPUS_CODE, COHORT, NULL_FLAG_6YR_GOALS, FTF_6YR_GOAL, FTF_6YR_GRAD, FTF_6YR_GRAD_LCL, FTF_6YR_GRAD_UCL, FTF_6YR_ACTUAL_FLAG, FTF_6YR_GRAD_TOTAL, FTF_6YR_GRAD_DIFF, FTF_6YR_SUMMARY1, FTF_6YR_SUMMARY2, FTF_6YR_SUMMARY3 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_6YR_PELL = <<<EOF
SELECT CAMPUS_CODE, COHORT, FTF_6YR_GOAL, FTF_6YR_GRAD_PELL, FTF_6YR_ACTUAL_FLAG, FTF_6YR_GRAD_NONPELL, FTF_6YR_ACTUAL_FLAG, FTF_6YR_GRAD_DIFF_PELL, FTF_6YR_GRAD_DIFF_NONPELL, PELL_GAP, PELL_SUMMARY1, PELL_SUMMARY2, PELL_SUMMARY3  
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_6YR_NONPELL = <<<EOF
SELECT CAMPUS_CODE, COHORT, FTF_6YR_GOAL, FTF_6YR_GRAD_NONPELL, FTF_6YR_GRAD_NONPELL_LCL, FTF_6YR_GRAD_NONPELL_UCL, FTF_6YR_ACTUAL_FLAG, PELL_SUMMARY1, PELL_SUMMARY2, PELL_SUMMARY3 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_6YR_URM = <<<EOF
SELECT CAMPUS_CODE, COHORT, FTF_6YR_GOAL, FTF_6YR_GRAD_URM, FTF_6YR_ACTUAL_FLAG, FTF_6YR_GRAD_NONURM, FTF_6YR_ACTUAL_FLAG, FTF_6YR_GRAD_DIFF_URM, FTF_6YR_GRAD_DIFF_NONURM, URM_GAP, URM_SUMMARY1, URM_SUMMARY2, URM_SUMMARY3 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_6YR_NONURM = <<<EOF
SELECT CAMPUS_CODE, COHORT, FTF_6YR_GOAL, FTF_6YR_GRAD_NONURM, FTF_6YR_GRAD_LCL_NONURM, FTF_6YR_GRAD_UCL_NONURM, FTF_6YR_ACTUAL_FLAG, URM_GAP, URM_SUMMARY1, URM_SUMMARY2, URM_SUMMARY3 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_TR_25YR = <<<EOF
SELECT CAMPUS_CODE, COHORT, NULL_FLAG_2YR_GOALS, TR_2YR_GOAL, TR_2YR_GRAD, TR_25YR_GRAD, TR_2YR_GRAD_LCL, TR_2YR_GRAD_UCL, TR_2YR_ACTUAL_FLAG, TR_2YR_GRAD_TOTAL, TR_2YR_GRAD_DIFF, TR_2YR_SUMMARY1, TR_2YR_SUMMARY2, TR_2YR_SUMMARY3
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_TR_45YR = <<<EOF
SELECT CAMPUS_CODE, COHORT, NULL_FLAG_4YR_GOALS, TR_4YR_GOAL, TR_4YR_GRAD, TR_45YR_GRAD, TR_4YR_GRAD_LCL, TR_4YR_GRAD_UCL, TR_4YR_ACTUAL_FLAG, TR_4YR_GRAD_TOTAL, TR_4YR_GRAD_DIFF, TR_4YR_SUMMARY1, TR_4YR_SUMMARY2, TR_4YR_SUMMARY3
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_45YR = <<<EOF
SELECT CAMPUS_CODE, COHORT, NULL_FLAG_4YR_GOALS, FTF_4YR_GOAL, FTF_4YR_GRAD, FTF_45YR_GRAD, FTF_4YR_GRAD_LCL, FTF_4YR_GRAD_UCL, FTF_4YR_ACTUAL_FLAG, FTF_4YR_GRAD_TOTAL, FTF_4YR_GRAD_DIFF, FTF_4YR_SUMMARY1, FTF_4YR_SUMMARY2, FTF_4YR_SUMMARY3 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_65YR = <<<EOF
SELECT CAMPUS_CODE, COHORT, NULL_FLAG_6YR_GOALS, FTF_6YR_GOAL, FTF_6YR_GRAD, FTF_65YR_GRAD, FTF_6YR_GRAD_LCL, FTF_6YR_GRAD_UCL, FTF_6YR_ACTUAL_FLAG, FTF_6YR_GRAD_TOTAL, FTF_6YR_GRAD_DIFF, FTF_6YR_SUMMARY1, FTF_6YR_SUMMARY2, FTF_6YR_SUMMARY3 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_65YR_PELL = <<<EOF
SELECT CAMPUS_CODE, COHORT, FTF_6YR_GOAL, FTF_6YR_GRAD_PELL, FTF_65YR_GRAD_PELL, FTF_6YR_ACTUAL_FLAG, FTF_65YR_GRAD_NONPELL, FTF_6YR_ACTUAL_FLAG, FTF_6YR_GRAD_DIFF_PELL, FTF_6YR_GRAD_DIFF_NONPELL, PELL_GAP, PELL_SUMMARY1, PELL_SUMMARY2, PELL_SUMMARY3   
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    const SELECT_FTF_65YR_URM = <<<EOF
SELECT CAMPUS_CODE, COHORT, FTF_6YR_GOAL, FTF_6YR_GRAD_URM, FTF_65YR_GRAD_URM, FTF_6YR_ACTUAL_FLAG, FTF_65YR_GRAD_NONURM, FTF_6YR_ACTUAL_FLAG, FTF_6YR_GRAD_DIFF_URM, FTF_6YR_GRAD_DIFF_NONURM, URM_GAP, URM_SUMMARY1, URM_SUMMARY2, URM_SUMMARY3 
FROM forecast
WHERE CAMPUS_CODE = ?
EOF;

    public function __construct() {}

    public function getSelectByCampus() {
        return self::SELECT_BY_CAMPUS;
    }

    public function getSelectTR2YR() {
        return self::SELECT_TR_2YR;
    }

    public function getSelectTR4YR() {
        return self::SELECT_TR_4YR;
    }

    public function getSelectFTF4YR() {
        return self::SELECT_FTF_4YR;
    }

    public function getSelectFTF6YR() {
        return self::SELECT_FTF_6YR;
    }

    public function getSelectFTF6YRPell() {
        return self::SELECT_FTF_6YR_PELL;
    }

    public function getSelectFTF6YRNonPell() {
        return self::SELECT_FTF_6YR_NONPELL;
    }

    public function getSelectFTF6YRURM() {
        return self::SELECT_FTF_6YR_URM;
    }

    public function getSelectFTF6YRNonURM() {
        return self::SELECT_FTF_6YR_NONURM;
    }

    public function getSelectTR25YR() {
        return self::SELECT_TR_25YR;
    }

    public function getSelectTR45YR() {
        return self::SELECT_TR_45YR;
    }

    public function getSelectFTF45YR() {
        return self::SELECT_FTF_45YR;
    }

    public function getSelectFTF65YR() {
        return self::SELECT_FTF_65YR;
    }

    public function getSelectFTF65YRPell() {
        return self::SELECT_FTF_65YR_PELL;
    }

    public function getSelectFTF65YRURM() {
        return self::SELECT_FTF_65YR_URM;
    }

}
