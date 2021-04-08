<?php

namespace Patient\Model;

use Neptune\{DbMapperUtility, Logger};

/**
 * PatientMedication
 * @package self-health
 * @author Randal Neptune
 */
class PatientMedication extends Logger {
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
        "quantityUnitId" => ["quantity_unit_id","T"],
        "comments" => ["comments", "T"]
    ); 
    
    protected $medicationId;
    protected $patientId;
    protected $dateTaken;
    protected $timeTaken;
    protected $quantityAmount;
    protected $quantityUnitId;
    protected $comments;
    
    protected $medication;
    protected $patient;
    protected $quantityUnit;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
        $this->medication = new \Admin\Model\Medication();
        $this->quantityUnit = new \Admin\Model\QuantityUnit();        
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

    public function getQuantityUnitId() {
        return $this->quantityUnitId;
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

    public function getQuantityUnit() {
        return $this->quantityUnit->getObjectById($this->getQuantityUnitId());
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

    public function setQuantityUnitId($quantityUnitId) {
        $this->quantityUnitId = $quantityUnitId;
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

    public function setQuantityUnit($quantityUnit) {
        $this->quantityUnit = $quantityUnit;
    }

    public function getMedicationsByPatient($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE, "id", $this->getClassName(), FALSE, "dateTaken");
    }
}
