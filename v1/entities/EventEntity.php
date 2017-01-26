<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/v1/controls/utilities/Guid.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 10/7/2015
 * Time: 4:24 PM
 */
class EventEntity
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
SELECT *
FROM event_shows
EOF;

    const SELECT_BY_ID_SQL = <<<EOF
SELECT *
FROM event_shows
WHERE id = ?
EOF;

    const SELECT_BY_LINK_SQL = <<<EOF
SELECT *
FROM event_shows
WHERE link = ?
LIMIT 1
EOF;

    const INSERT_SQL = <<<EOF
INSERT INTO `event_shows` (`title`, `description`, `link`, `imageFile`, `createdBy`, `createdAtDate`, `eventStartDate`, `eventStartTime`, `eventEndDate`, `eventEndTime`, `eventId`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
EOF;

    const UPDATE_SQL = <<<EOF
UPDATE event_shows
SET title=?, description=?, link=?, imageFile=?, createdBy=?
WHERE eventId=?";
EOF;

    protected $title;
    protected $description;
    protected $link;
    protected $imageFile;
    protected $createdBy;
    protected $createdAtDate;
    protected $eventStartDate;
    protected $eventStartTime;
    protected $eventEndDate;
    protected $eventEndTime;
    protected $eventId;

    public function __construct() {
        $this->table = 'event_shows';
        $createId = new Guid();
        $guId = $createId->guid();
        $this->setEventId($guId);
    }

    public function mapData($data) {
        $this->setTitle($data['title']);
        $this->setDescription($data['description']);
        $this->setLink($data['link']);
        $this->setImageFile($data['imageFile']);
        $this->setCreatedBy($data['createdBy']);
        $this->setCreatedAtDate();
        $this->setEventStartDate($data['startDate']);
        $this->setEventStartTime($data['startTime']);
        $this->setEventEndDate($data['endDate']);
        $this->setEventEndTime($data['endTime']);
    }

    public function getSelectAllSql() {
        return self::SELECT_ALL_SQL;
    }

    public function getInsertSql() {
        return self::INSERT_SQL;
    }

    public function getSelectByLinkSql() {
        return self::SELECT_BY_LINK_SQL;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function getImageFile() {
        return $this->imageFile;
    }

    public function setImageFile($imageFile) {
        $this->imageFile = $imageFile;
    }

    public function getCreatedBy() {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function getCreatedAtDate() {
        return $this->createdAtDate;
    }

    public function setCreatedAtDate() {
        $this->createdAtDate =  date("Y-m-d H:i:s");
    }

    public function getEventStartDate() {
        return $this->eventStartDate;
    }

    public function setEventStartDate($startDate) {
        $this->eventStartDate = $startDate;
    }

    public function getEventStartTime() {
        return $this->eventStartTime;
    }

    public function setEventStartTime($startTime) {
        $this->eventStartTime = $startTime;
    }

    public function getEventEndDate() {
        return $this->eventEndDate;
    }

    public function setEventEndDate($endDate) {
        $this->eventEndDate = $endDate;
    }

    public function getEventEndTime() {
        return $this->eventEndTime;
    }

    public function setEventEndTime($endTime) {
        $this->eventEndTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param mixed $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }
}



