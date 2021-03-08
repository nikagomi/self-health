<?php

namespace Utility\Model;

use Neptune\DbMapper;
use Neptune\DbMapperUtility;

/** Manages notifications in the application.
 * @package sarms
 * @author Randal Neptune
 */
class Notification extends DbMapper {

    protected $_tableName = "edu_notifications";
    protected $primaryKeyField = "notification_id";
    
    protected $uniqueCombo;
    protected $uniqueComboErrorMsg;
    
    protected $fieldMapper = array(
        "id" => array("notification_id", "T"),
        "message" => array("message", "T"),
        "header" => array("category", "T"),
        "createdTime" => array("created_time", "D"),
        "roleConstant" => array("role_constant", "T"),
        "facilityId" => array("facility_id", "T"),
        "userId" => array("user_id", "T"),
        "updatedById" => array("updated_by_id", "T"),
        "updatedTime" => array("updated_time", "D"),
        "acknowledged" => array("acknowledged", "B")
    );
    protected $message;
    protected $header;
    protected $createdTime;
    protected $roleConstant;
    protected $userId;
    protected $updatedById;
    protected $updatedTime;
    protected $acknowledged;
    protected $facilityId;
    
    protected $user;
    protected $updatedBy;
    protected $facility;

    public function __construct() {
        parent::__construct();
        $this->user = new \Authentication\Model\EduUser();
        $this->updatedBy = new \Authentication\Model\EduUser();
        $this->facility = new \Admin\Model\EduFacility();
    }

    public function getMessage() {
        return $this->message;
    }

    public function getHeader() {
        return $this->header;
    }

    public function getCreatedTime() {
        return $this->createdTime;
    }

    public function getRoleConstant() {
        return $this->roleConstant;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getUpdatedById() {
        return $this->updatedById;
    }

    public function getUpdatedTime() {
        return $this->updatedTime;
    }

    public function getUser() {
        return $this->user->getEntityById($this->getUserId());
    }

    public function getUpdatedBy() {
        return $this->updatedBy->getEntityById($this->getUpdatedById());
    }

    public function isAcknowledged() {
        return ($this->acknowledged == 't' || $this->acknowledged == 1) ? (bool) true : (bool) false;
    }
    
    public function getFacilityId() {
        return $this->facilityId;
    }

    public function getFacility() {
        return $this->facility->getEntityById($this->getFacilityId());
    }

    public function setFacilityId($facilityId) {
        $this->facilityId = $facilityId;
    }

    public function setFacility($facility) {
        $this->facility = $facility;
    }

    public function setAcknowledged($acknowledged) {
        $this->acknowledged = $acknowledged;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setHeader($header) {
        $this->header = $header;
    }

    public function setCreatedTime($createdTime) {
        $this->createdTime = $createdTime;
    }

    public function setRoleConstant($roleConstant) {
        $this->roleConstant = $roleConstant;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setUpdatedById($updatedById) {
        $this->updatedById = $updatedById;
    }

    public function setUpdatedTime($updatedTime) {
        $this->updatedTime = $updatedTime;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setUpdatedBy($updatedBy) {
        $this->updatedBy = $updatedBy;
    }

    /**
     * Returns all the notifications for a user based on their user id.
     * @param string$userId
     * @return type 
     */
    public function getNotificationsByUserId($userId) {
        return DbMapperUtility::convertObjectArrToJsonArray($this->getObjectsByMultipleCriteria(["userId"], ["$userId"], TRUE));
        /*$objArr = array();
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE user_id = '" . $userId . "'";
        $sql .= " AND acknowledged = false ORDER BY created_time ASC";

        $result = $this->dbQuery($sql);
        $i = 0;
        while ($res = $this->dbFetchArrayAssociative($result)) {
            $objArr[$i] = $res;
            $i++;
        }
        return $objArr;*/
    }

    /**
     * Returns all the notifications for a user based on their user id and/or associated permissions.
     * @param string $userId
     * @return array
     */
    public function getNotificationsForUser($userId, $facilityId) {
        $constArr = (new \Authentication\Model\EduPermissionManager())->getUserPermissionConstants($userId);
        
        $objArr = array();
        $sql = " SELECT * FROM " . $this->getTableName() . " WHERE acknowledged = false AND updated_time is null";
        $sql .= " AND updated_by_id is null AND (facility_id = '".$facilityId."' OR facility_id is null) order by created_time DESC";
       
        $result = DbMapperUtility::dbQuery($sql);
        if (DbMapperUtility::dbNumRows($result) > 0) {
            $i = 0;
            while ($res = DbMapperUtility::dbFetchArrayAssociative($result)) {
                if ($res['user_id'] == $userId or \in_array(\strtoupper($res['role_constant']), $constArr)) {
                    $objArr[$i] = $res;
                    $i++;
                }
            }
        }
        return $objArr;
    }

}
