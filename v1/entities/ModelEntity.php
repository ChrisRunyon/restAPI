<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/utilities/Guid.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/7/2015
 * Time: 4:24 PM
 */
class ModelEntity
{

    const SELECT_SEATS_BY_ID = <<<EOF
SELECT u.*, b.seatId, b.date
FROM seating_chart u JOIN seatId b ON u.id = b.userId
WHERE b.date = (SELECT MAX(date) FROM balance WHERE userId = u.id);
EOF;

    const SELECT_BETWEEN_DATE_RANGE = <<<EOF
SELECT *, start_date, end_date FROM seating_chart WHERE date(now()) BETWEEN start_date AND end_date
EOF;

    const SELECT_ALL_SQL = <<<EOF
SELECT id, link, modelImageFile, user_id
FROM model_mode
ORDER BY id DESC
EOF;

    const SELECT_BY_ID_SQL = <<<EOF
SELECT *
FROM model_modei
WHERE id = ?
EOF;

    const SELECT_ALL_BY_USER_SQL = <<<EOF
SELECT *
FROM model_mode
WHERE user_id = ?
EOF;

    const SELECT_BY_LINK_SQL = <<<EOF
SELECT modelName, modelDescription, modelFile, modelAsset, user_id
FROM model_mode
WHERE link = ?
LIMIT 1
EOF;

    const INSERT_SQL = <<<EOF
INSERT INTO `model_mode` (`modelId`, `modelName`, `modelDescription`, `modelFile`, `modelAsset`, `link`, `modelImageFile`, `user_id`, `createdAtDate`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
EOF;

    const UPDATE_SQL = <<<EOF
UPDATE `model_mode`
SET `modelName`=:modelName, `modelDescription`=:modelDescription, `modelImageFile`=:modelImageFile
WHERE `modelId`=:modelId
EOF;

    protected $modelId;
    protected $modelName;
    protected $modelDescription;
    protected $modelFile;
    protected $modelAsset;
    protected $modelPageLink;
    protected $modelImageFile;
    //protected $author;
    //protected $license;
    protected $user_id;
    protected $createdAtDate;

    public function __construct() {
        $this->table = 'model_mode';
        $createId = new Guid();
        $guId = $createId->guid();
        $this->setModelId($guId);
    }

    public function mapData($data) {
        $this->setModelName($data['name']);
        $this->setModelDescription($data['description']);
        $this->setModelFile($data['file']);
        $this->setModelAsset($data['asset']);
        $this->setModelPageLink($data['link']);
        $this->setModelImageFile($data['image']);
        //$this->setAuthor($data['author']);
        //$this->setLicense($data['license']);
        $this->setUserId($data['user_id']);
        $this->setCreatedAtDate();
    }

    public function getSelectAllSql() {
        return self::SELECT_ALL_SQL;
    }

    public function getInsertSql() {
        return self::INSERT_SQL;
    }

    public function getSelectByURLSql() {
        return self::SELECT_BY_LINK_SQL;
    }

    public function getSelectAllByUserIdSql() {
        return self::SELECT_ALL_BY_USER_SQL;
    }

    public function getUpdateSql() {
        return self::UPDATE_SQL;
    }

    /**
     * @return mixed
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @param mixed $modelId
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
    }

    /**
     * @return mixed
     */
    public function getModelName()
    {
        return $this->modelName;
    }

    /**
     * @param mixed $modelName
     */
    public function setModelName($modelName)
    {
        $this->modelName = $modelName;
    }

    /**
     * @return mixed
     */
    public function getModelDescription()
    {
        return $this->modelDescription;
    }

    /**
     * @param mixed $modelDescription
     */
    public function setModelDescription($modelDescription)
    {
        $this->modelDescription = $modelDescription;
    }

    /**
     * @return mixed
     */
    public function getModelFile()
    {
        return $this->modelFile;
    }

    /**
     * @param mixed $modelFile
     */
    public function setModelFile($modelFile)
    {
        $this->modelFile = $modelFile;
    }

    /**
     * @return mixed
     */
    public function getModelAsset()
    {
        return $this->modelAsset;
    }

    /**
     * @param mixed $modelAsset
     */
    public function setModelAsset($modelAsset)
    {
        $this->modelAsset = $modelAsset;
    }

    /**
     * @return mixed
     */
    public function getModelPageLink()
    {
        return $this->modelPageLink;
    }

    /**
     * @param mixed $modelPageLink
     */
    public function setModelPageLink($modelPageLink)
    {
        $this->modelPageLink = $modelPageLink;
    }

    /**
     * @return mixed
     */
    public function getModelImageFile()
    {
        return $this->modelImageFile;
    }

    /**
     * @param mixed $modelImageFile
     */
    public function setModelImageFile($modelImageFile)
    {
        $this->modelImageFile = $modelImageFile;
    }

    /**
     * @return mixed
     */
    /*public function getAuthor()
    {
        return $this->author;
    }*/

    /**
     * @param mixed $author
     */
    /*public function setAuthor($author)
    {
        $this->author = $author;
    }*/

    /**
     * @return mixed
     */
    /*public function getLicense()
    {
        return $this->license;
    }*/

    /**
     * @param mixed $license
     */
    /*public function setLicense($license)
    {
        $this->license = $license;
    }*/

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
        return $this->createdAtDate;
    }

    /**
     *
     */
    public function setCreatedAtDate()
    {
        $this->createdAtDate = date("Y-m-d H:i:s");
    }
}
