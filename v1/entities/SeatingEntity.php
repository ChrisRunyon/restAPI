<?php

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/7/2015
 * Time: 3:42 PM
 */
class SeatingEntity
{
    const SELECT_ALL_SQL = <<<EOF
SELECT *
FROM seating
EOF;

    const SELECT_BY_ID_SQL = <<<EOF
SELECT sid, color, designation, date, price
FROM seating
WHERE id = ?
EOF;

    protected $table;
    private $id;
    private $sid;
    private $title;
    private $price;
    private $designation;
    private $color;
    private $type;
    private $assignedAtDate;
    private $startAtDate;
    private $endAtDate;
    private $visible;
    private $updatedAtDate;
    private $createdAtDate;
    private $modifiedBy;

    public function __construct() {
        $this->table = 'seating';
    }

    public function mapData($data) {
        $this->setId($data['id']);
        $this->setSid($data['sid']);
        $this->setTitle($data['title']);
        $this->setPrice($data['price']);
        $this->setDesignation($data['designation']);
        $this->setColor($data['color']);
        $this->setType($data['type']);
        $this->setAssignedAtDate($data['assignAtDate']);
        $this->setStartAtDate($data['startAtDate']);
        $this->setEndAtDate($data['endAtDate']);
        $this->setVisible($data['visible']);
        $this->setUpdatedAtDate($data['updatedAtDate']);
        $this->setCreatedAtDate($data['createdAtDate']);
        $this->setModifiedBy($data['modifiedBy']);
    }

    public function getTable() {
        return $this->table;
    }

    public function getSelectAllSql() {
        return self::SELECT_ALL_SQL;
    }

    public function getSelectByIdSql() {
        return self::SELECT_BY_ID_SQL;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getSid() {
        return $this->sid;
    }

    public function setSid($sid) {
        $this->sid = $sid;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getDesignation() {
        return $this->designation;
    }

    public function setDesignation($designation) {
        $this->designation = $designation;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getAssignedAtDate() {
        return $this->assignedAtDate;
    }

    public function setAssignedAtDate($assignedAtDate) {
        $this->assignedAtDate = $assignedAtDate;
    }

    public function getStartAtDate() {
        return $this->startAtDate;
    }

    public function setStartAtDate($startAtDate) {
        $this->startAtDate = $startAtDate;
    }

    public function getEndAtDate() {
        return $this->endAtDate;
    }

    public function setEndAtDate($endAtDate) {
        $this->endAtDate = $endAtDate;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible) {
        $this->visible = $visible;
    }

    public function getUpdatedAtDate() {
        return $this->updatedAtDate;
    }

    public function setUpdatedAtDate($updatedAtDate) {
        $this->updatedAtDate = $updatedAtDate;
    }

    public function getCreatedAtDate() {
        return $this->createdAtDate;
    }

    public function setCreatedAtDate($createdAtDate) {
        $this->createdAtDate = $createdAtDate;
    }

    public function getModifiedBy() {
        return $this->modifiedBy;
    }

    public function setModifiedBy($modifiedBy) {
        $this->modifiedBy = $modifiedBy;
    }
}

