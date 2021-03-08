<?php

namespace Patient\Model;

use Neptune\{Logger, Modifiable, DbMapperUtility};

/**
 * PatientMealRecord
 * @package self-health
 * @author Randal Neptune
 */
class PatientMealRecord extends Logger implements Modifiable {
    protected $_tableName = "patient_meal_records";
    protected $primaryKeyField = "patient_meal_record_id";

    protected $uniqueCombo = [["patientId","dateConsumed","timeConsumed"]];
    protected $uniqueComboErrorMsg = "A meal record of the type or for the stipulated date and time already exists.";

    protected $fieldMapper = array(
        "id" => ["patient_meal_record_id","T"],
        "patientId" => ["patient_id","T"],
        "mealTypeId" => ["meal_type_id","T"],
        "dateConsumed" => ["date_consumed","D"],
        "timeConsumed" => ["time_consumed","D"],
        "notes" => ["notes","T"],
        "createdTime" => ["created_time","TS"],
        "createdById" => ["created_by_id","T"],
        "modifiedTime" => ["modified_time","TS"],
        "modifiedById" => ["modified_by_id","T"]
    );
    
    protected $patientId;
    protected $mealTypeId;
    protected $dateConsumed;
    protected $timeConsumed;
    protected $notes;
    protected $createdTime;
    protected $createdById;
    protected $modifiedTime;
    protected $modifiedById;
    
    protected $patient;
    protected $mealType;
    protected $createdBy;
    protected $modifiedBy;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
        $this->createdBy = new \Authentication\Model\User();
        $this->modifiedBy = new \Authentication\Model\User();
        $this->mealType = new \Clinical\Model\MealType();
    }
    
    public function getPatientId() {
        return $this->patientId;
    }

    public function getMealTypeId() {
        return $this->mealTypeId;
    }

    public function getDateConsumed() {
        return $this->dateConsumed;
    }
    
    public function displayDateConsumed() {
        return DbMapperUtility::formatSqlDate($this->getDateConsumed());
    }

    public function getTimeConsumed() {
        return $this->timeConsumed;
    }
    
    public function displayTimeConsumed() {
        return DbMapperUtility::twelveHrAmPm($this->getTimeConsumed());
    }

    public function getNotes() {
        return $this->notes;
    }

    public function getCreatedTime() {
        return $this->createdTime;
    }

    public function getCreatedById() {
        return $this->createdById;
    }

    public function getModifiedTime() {
        return $this->modifiedTime;
    }

    public function getModifiedById() {
        return $this->modifiedById;
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
    }

    public function getMealType() {
        return $this->mealType->getObjectById($this->getMealTypeId());
    }

    public function getCreatedBy() {
        return $this->createdBy->getObjectById($this->getCreatedById());
    }

    public function getModifiedBy() {
        return $this->modifiedBy->getObjectById($this->getModifiedById());
    }

    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setMealTypeId($mealTypeId) {
        $this->mealTypeId = $mealTypeId;
    }

    public function setDateConsumed($dateConsumed) {
        $dateObj = \DateTime::createFromFormat("M d, Y", $dateConsumed);
        $this->dateConsumed = $dateObj->format("Y-m-d");
    }

    public function setTimeConsumed($timeConsumed) {
        $timeObj = \DateTime::createFromFormat("g:i A", $timeConsumed);
        $this->timeConsumed = $timeObj->format("H:i:s");
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }

    public function setCreatedTime($createdTime) {
        $this->createdTime = $createdTime;
    }

    public function setCreatedById($createdById) {
        $this->createdById = $createdById;
    }

    public function setModifiedTime($modifiedTime) {
        $this->modifiedTime = $modifiedTime;
    }

    public function setModifiedById($modifiedById) {
        $this->modifiedById = $modifiedById;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setMealType($mealType) {
        $this->mealType = $mealType;
    }

    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function setModifiedBy($modifiedBy) {
        $this->modifiedBy = $modifiedBy;
    }

    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE, "id", $this->getClassName(), FALSE, "dateConsumed");
    }
    
    public function getAssociatedFoodGroups() {
        return (new PatientMealRecordFoodGroup())->getByPatientMealRecordId($this->getId());
    }
    
    public function getMealFoodGroups () {
        $objArr = [];
        $afgs = $this->getAssociatedFoodGroups();
        foreach ($afgs as $afg) {
            \array_push($objArr, $afg->getFoodGroup());
        }
        return $objArr;
    }
}
