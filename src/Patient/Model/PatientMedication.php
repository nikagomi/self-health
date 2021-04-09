<?php

namespace Patient\Model;

use Neptune\{DbMapperUtility, Logger, Modifiable};

/**
 * PatientMedication
 * @package self-health
 * @author Randal Neptune
 */
class PatientMedication extends Logger implements Modifiable {
    protected $_tableName = "patient_medications";
    protected $primaryKeyField = "patient_medication_id";

    protected $uniqueCombo;
    protected $uniqueComboErrorMsg;

    protected $fieldMapper = array(
        "id" => ["patient_medication_id","T"],
        "medicationId" => ["medication_id","T"],
        "patientId" => ["patient_id","T"],
        "dateTaken" => ["date_taken","D"],
        "timeTaken" => ["time_taken", "D"],
        "quantityAmount" => ["quantity_amount","I"],
        "quantityTakenUnitId" => ["quantity_taken_unit_id","T"],
        "comments" => ["comments", "T"],
        "createdById" => ["created_by_id","T"],
        "createdTime" => ["created_time","TS"],
        "modifiedById" => ["modified_by_id","T"],
        "modifiedTime" => ["modified_time","TS"]
    ); 
    
    protected $medicationId;
    protected $patientId;
    protected $dateTaken;
    protected $timeTaken;
    protected $quantityAmount;
    protected $quantityTakenUnitId;
    protected $comments;
    protected $createdById;
    protected $createdTime;
    protected $modifiedById;
    protected $modifiedTime;
    
    protected $medication;
    protected $patient;
    protected $quantityTakenUnit;
    protected $createdBy;
    protected $modifiedBy;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
        $this->medication = new \Admin\Model\Medication();
        $this->quantityTakenUnit = new \Admin\Model\QuantityTakenUnit(); 
        $this->createdBy = new \Authentication\Model\User();
        $this->modifiedBy = new \Authentication\Model\User();
    }
    
    public function getMedicationId() {
        return $this->medicationId;
    }

    public function getPatientId() {
        return $this->patientId;
    }

    public function getDateTaken() {
        return $this->dateTaken;
    }
    
    public function displayDateTaken() {
        return DbMapperUtility::formatSqlDate($this->getDateTaken());
    }

    public function getTimeTaken() {
        return $this->timeTaken;
    }
    
    public function displayTimeTaken() {
        return DbMapperUtility::twelveHrAmPm($this->getTimeTaken());
    }

    public function getQuantityAmount() {
        return $this->quantityAmount;
    }

    public function getQuantityTakenUnitId() {
        return $this->quantityTakenUnitId;
    }

    public function getComments() {
        return $this->comments;
    }

    public function getMedication() {
        return $this->medication->getObjectById($this->getMedicationId());
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
    }

    public function getQuantityTakenUnit() {
        return $this->quantityTakenUnit->getObjectById($this->getQuantityTakenUnitId());
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
    
    public function getCreatedBy() {
        return $this->createdBy->getObjectById($this->getCreatedById());
    }

    public function getModifiedBy() {
        return $this->modifiedBy->getObjectById($this->getModifiedById());
    }

    public function setMedicationId($medicationId) {
        $this->medicationId = $medicationId;
    }

    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setDateTaken($dateTaken) {
        $dateObj = \DateTime::createFromFormat("M d, Y", $dateTaken);
        $this->dateTaken = $dateObj->format("Y-m-d");
    }

    public function setTimeTaken($timeTaken) {
        $time = '';
        if (\trim($timeTaken) != '') {
            $timeObj = \DateTime::createFromFormat("g:i A", $timeTaken);
            $time = $timeObj->format("H:i:s");
        } 
        $this->timeTaken = $timeTaken;
    }

    public function setQuantityAmount($quantityAmount) {
        $this->quantityAmount = $quantityAmount;
    }

    public function setQuantityTakenUnitId($quantityTakenUnitId) {
        $this->quantityTakenUnitId = $quantityTakenUnitId;
    }

    public function setComments($comments) {
        $this->comments = $comments;
    }

    public function setMedication($medication) {
        $this->medication = $medication;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setQuantityTakenUnit($quantityTakenUnit) {
        $this->quantityTakenUnit = $quantityTakenUnit;
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
    
    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function setModifiedBy($modifiedBy) {
        $this->modifiedBy = $modifiedBy;
    }

    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE, "id", $this->getClassName(), FALSE, "dateTaken");
    }
}
