<?php

namespace SelfReport\Model;

use Neptune\{Logger, Modifiable, DbMapperUtility};

/**
 * PatientPhysicalActivity
 * @package self-health
 * @author Randal Neptune
 */
class PatientPhysicalActivity extends Logger implements Modifiable {
    protected $_tableName = "patient_physical_activities";
    protected $primaryKeyField = "patient_physical_activity_id";

    protected $uniqueCombo;
    protected $uniqueComboErrorMsg;

    protected $fieldMapper = array(
        "id" => ["patient_physical_activity_id","T"],
        "patientId" => ["patient_id","T"],
        "datePerformed" => ["date_performed","D"],
        "timeStarted" => ["time_performed","D"],
        "physicalActivityId" => ["physical_activity_id","T"],
        "durationInMinutes" => ["duration_in_minutes","I"],
        "notes" => ["notes","T"],
        "createdById" => ["created_by_id","T"],
        "createdTime" => ["created_time","TS"],
        "modifiedById" => ["modified_by_id","T"],
        "modifiedTime" => ["modified_time","TS"]
    );
    
    protected $patientId;
    protected $datePerformed;
    protected $timeStarted;
    protected $physicalActivityId;
    protected $durationInMinutes;
    protected $notes;
    protected $createdById;
    protected $createdTime;
    protected $modifiedById;
    protected $modifiedTime;
    
    protected $patient;
    protected $createdBy;
    protected $modifiedBy;
    protected $physicalActivity;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new \Patient\Model\Patient();
        $this->createdBy = new \Authentication\Model\User();
        $this->modifiedBy = new \Authentication\Model\User();
        $this->physicalActivity = new \Admin\Model\PhysicalActivity();
    }
    
    public function getPatientId() {
        return $this->patientId;
    }

    public function getDatePerformed() {
        return $this->datePerformed;
    }
    
    public function displayDatePerformed() {
        return DbMapperUtility::formatSqlDate($this->getDatePerformed());
    }

    public function getTimeStarted() {
        return $this->timeStarted;
    }
    
    public function displayTimeStarted() {
        return DbMapperUtility::twelveHrAmPm($this->getTimeStarted());
    }

    public function getPhysicalActivityId() {
        return $this->physicalActivityId;
    }

    public function getDurationInMinutes() {
        return $this->durationInMinutes;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function getCreatedById() {
        return $this->createdById;
    }

    public function getCreatedTime() {
        return $this->createdTime;
    }

    public function getModifiedById() {
        return $this->modifiedById;
    }

    public function getModifiedTime() {
        return $this->modifiedTime;
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
    }

    public function getCreatedBy() {
        return $this->createdBy->getObjectById($this->getCreatedById());
    }

    public function getModifiedBy() {
        return $this->modifiedBy->getObjectById($this->getModifiedById());
    }
    
    public function getPhysicalActivity() {
        return $this->physicalActivity->getObjectById($this->getPhysicalActivityId());
    }

    public function setPhysicalActivity($physicalActivity) {
        $this->physicalActivity = $physicalActivity;
    }

    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setDatePerformed($datePerformed) {
        $dateObj = \DateTime::createFromFormat("M d, Y", $datePerformed);
        $this->datePerformed = $dateObj->format("Y-m-d");
    }

    public function setTimeStarted($timeStarted) {
        $time = '';
        if (\trim($timeStarted) != '') {
            $timeObj = \DateTime::createFromFormat("g:i A", $timeStarted);
            $time = $timeObj->format("H:i:s");
        } 
        $this->timeStarted = $timeStarted;
    }

    public function setPhysicalActivityId($physicalActivityId) {
        $this->physicalActivityId = $physicalActivityId;
    }

    public function setDurationInMinutes($durationInMinutes) {
        $this->durationInMinutes = $durationInMinutes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }

    public function setCreatedById($createdById) {
        $this->createdById = $createdById;
    }

    public function setCreatedTime($createdTime) {
        $this->createdTime = $createdTime;
    }

    public function setModifiedById($modifiedById) {
        $this->modifiedById = $modifiedById;
    }

    public function setModifiedTime($modifiedTime) {
        $this->modifiedTime = $modifiedTime;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function setModifiedBy($modifiedBy) {
        $this->modifiedBy = $modifiedBy;
    }

    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE , "id", $this->getClassName(), FALSE, "datePerformed");
    }
}
