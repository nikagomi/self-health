<?php

namespace Authentication\Model;

use Neptune\Logger;

/**
 * TwoFAUserBackupCode
 * @package hiags
 * @author Randal Neptune
 */
class TwoFAUserBackupCode extends Logger {
    protected $_tableName = "twofa_user_backup_codes";
    protected $primaryKeyField = "user_backup_code_id";

    protected $uniqueCombo = array(array("userId","backupCode"));
    protected $uniqueComboErrorMsg;

    protected $fieldMapper = array(
        "id" => array("user_backup_code_id","T"),
        "userId" => array("user_id","T"),
        "backupCode" => array("backup_code","T"),
        "sortOrder" => array("sort_order","I"),
        "timeUsed" => array("time_used","TS"),
        "used" => array("used","B")
    );
    
    protected $userId;
    protected $backupCode;
    protected $sortOrder;
    protected $timeUsed;
    protected $used;
    
    protected $user;
    
    public function __construct() {
        parent::__construct();
        $this->user = new EduUser();
    }
    
    public function getUserId() {
        return $this->userId;
    }

    public function getBackupCode() {
        return $this->backupCode;
    }

    public function getSortOrder() {
        return $this->sortOrder;
    }

    public function getTimeUsed() {
        return $this->timeUsed;
    }

    public function getUser() {
        return $this->user->getObjectById($this->getUserId());
    }
    
    public function getUsed() {
        return $this->used;
    }
    
    public function isUsed() {
        return ($this->used == 't' || $this->used == 1) ? (bool) true : (bool) false;
    }
    
    public function isNotUsed() {
        return !$this->isUsed();
    }

    public function setUsed($used) {
        $this->used = $used;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setBackupCode($backupCode) {
        $this->backupCode = $backupCode;
    }

    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;
    }

    public function setTimeUsed($timeUsed) {
        $this->timeUsed = $timeUsed;
    }

    public function setUser($user) {
        $this->user = $user;
    }
    
    public function nextAvailableCode ($userId) {
        return $this->getEntityByMultipleCriteria(["userId", "used"], [$userId, FALSE], true);
    }
    
    public function isCodeAvailable ($userId) {
        $numCodes = $this->countByCriteria(["used","userId"], [FALSE, $userId], TRUE);
        return ($numCodes > 0) ? (bool) true : (bool) false;
    }

}
