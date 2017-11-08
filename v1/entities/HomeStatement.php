<?php

class HomeStatement
{

    const SELECT_GOALS_BY_CAMPUS = <<<EOF
SELECT *
FROM homepage
WHERE CAMPUS_CODE = ?
EOF;

	const SELECT_FTF_4YR = <<<EOF
SELECT FTF_4YR_COLOR
FROM homepage
WHERE CAMPUS_CODE = ? 
EOF;

	const SELECT_FTF_6YR = <<<EOF
SELECT FTF_6YR_COLOR
FROM homepage
WHERE CAMPUS_CODE = ?
EOF;

	const SELECT_TR_2YR = <<<EOF
SELECT TR_2YR_COLOR 
FROM homepage
WHERE CAMPUS_CODE = ? 
EOF;

	const SELECT_TR_4YR = <<<EOF
SELECT TR_4YR_COLOR
FROM homepage
WHERE CAMPUS_CODE = ?
EOF;

	const SELECT_PELL_6YR = <<<EOF
SELECT PELL_6YR_COLOR
FROM homepage
WHERE CAMPUS_CODE = ? 
EOF;

	const SELECT_URM_6YR = <<<EOF
SELECT URM_6YR_COLOR 
FROM homepage
WHERE CAMPUS_CODE = ?
EOF;

    public function __construct() {}

    public function getSelectAllByCampus() {
        return self::SELECT_GOALS_BY_CAMPUS;
    }

    public function getSelectFTF4YR() {
    	return self::SELECT_FTF_4YR;
    }

    public function getSelectFTF6YR() {
    	return self::SELECT_FTF_6YR;
    }

    public function getSelectTR2YR() {
    	return self::SELECT_TR_2YR;
    }

    public function getSelectTR4YR() {
    	return self::SELECT_TR_4YR;
    }

    public function getSelectPell4YR() {
    	return self::SELECT_PELL_4YR;
    }

    public function getSelectURM6YR() {
    	return self::SELECT_URM_6YR;
    }

}
