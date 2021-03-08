<?php


namespace Patient\Model;

use Neptune\{Logger, DbMapperUtility};

/**
 * PatientSmokingDrinkingStatus
 * package self-health
 * @author Randal Neptune
 */
class PatientSmokingDrinkingStatus extends Logger {
    protected $_tableName = "patient_smoking_drinking_statuses";
    protected $primaryKeyField = "patient_smoking_drinking_status_id";

    protected $uniqueCombo = [["patientId"]];
    protected $uniqueComboErrorMsg = "There already exists a smoking/drinking status record for the patient.";

    protected $fieldMapper = [
        "id" => ["patient_smoking_drinking_status_id","T"],
        "patientId" => ["patient_id","T"],
        "smoker" => ["smoker","B"],
        "smokingSinceQuantity" => ["smoking_since_quantity","I"],
        "smokingSinceInterval" => ["smoking_since_interval","T"],
        "smokingFrequency" => ["smoking_frequency","T"],
        "stopSmokingDate" => ["stop_smoking_date","D"],
        "smokingComments" => ["smoking_comments","T"],
        "drinker" => ["drinker","B"],
        "drinkingSinceQuantity" => ["drinking_since_quantity","I"],
        "drinkingSinceInterval" => ["drinking_since_interval","T"],
        "drinkingFrequency" => ["drinking_frequency","T"],
        "stopDrinkingDate" => ["stop_drinking_date","D"],
        "drinkingComments" => ["drinking_comments","T"],
        "stoppedDrinking" => ["stopped_drinking","B"],
        "stoppedSmoking" => ["stopped_smoking","B"],
    ];
    
    protected $patientId;
    protected $smoker;
    protected $smokingSinceQuantity;
    protected $smokingSinceInterval;
    protected $smokingFrequency;
    protected $stopSmokingDate;
    protected $smokingComments;
    protected $drinker;
    protected $drinkingSinceQuantity;
    protected $drinkingSinceInterval;
    protected $drinkingFrequency;
    protected $stopDrinkingDate;
    protected $drinkingComments;
    protected $stoppedDrinking;
    protected $stoppedSmoking;
    
    protected $patient;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
    }
    
    public function getPatientId() {
        return $this->patientId;
    }

    public function getSmoker() {
        return $this->smoker;
    }
    
    public function isSmoker() {
        return ($this->smoker == 't' || $this->smoker == 1) ? (bool) true : (bool) false;
    }

    public function getSmokingSinceQuantity() {
        return $this->smokingSinceQuantity;
    }

    public function getSmokingSinceInterval() {
        return $this->smokingSinceInterval;
    }

    public function getSmokingFrequency() {
        return $this->smokingFrequency;
    }

    public function getStopSmokingDate() {
        return $this->stopSmokingDate;
    }

    public function displayStopSmokingDate() {
        return DbMapperUtility::formatSqlDate($this->getStopSmokingDate());
    }
    
    public function getSmokingComments() {
        return $this->smokingComments;
    }

    public function getDrinker() {
        return $this->drinker;
    }
    
    public function isDrinker() {
        return ($this->drinker == 't' || $this->drinker == 1) ? (bool) true : (bool) false;
    }

    public function getDrinkingSinceQuantity() {
        return $this->drinkingSinceQuantity;
    }

    public function getDrinkingSinceInterval() {
        return $this->drinkingSinceInterval;
    }

    public function getDrinkingFrequency() {
        return $this->drinkingFrequency;
    }

    public function getStopDrinkingDate() {
        return $this->stopDrinkingDate;
    }
    
    public function displayStopDrinkingDate() {
        return DbMapperUtility::formatSqlDate($this->getStopDrinkingDate());
    }

    public function getDrinkingComments() {
        return $this->drinkingComments;
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
    }
    
    public function getStoppedDrinking() {
        return $this->stoppedDrinking;
    }
    
    public function hasStoppedDrinking() {
        return ($this->stoppedDrinking == 1 || $this->stoppedDrinking == 't') ? (bool) true : (bool) false;
    }

    public function getStoppedSmoking() {
        return $this->stoppedSmoking;
    }
    
    public function hasStoppedSmoking() {
        return ($this->stoppedSmoking == 1 || $this->stoppedSmoking == 't') ? (bool) true : (bool) false;
    }
    
    public function setStoppedDrinking($stoppedDrinking) {
        $this->stoppedDrinking = $stoppedDrinking;
    }

    public function setStoppedSmoking($stoppedSmoking) {
        $this->stoppedSmoking = $stoppedSmoking;
    }

    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setSmoker($smoker) {
        $this->smoker = $smoker;
    }

    public function setSmokingSinceQuantity($smokingSinceQuantity) {
        $this->smokingSinceQuantity = $smokingSinceQuantity;
    }

    public function setSmokingSinceInterval($smokingSinceInterval) {
        $this->smokingSinceInterval = $smokingSinceInterval;
    }

    public function setSmokingFrequency($smokingFrequency) {
        $this->smokingFrequency = $smokingFrequency;
    }

    public function setStopSmokingDate($stopSmokingDate) {
        $stopDate = '';
        if (\trim($stopSmokingDate) != '') { 
            $dateObj = \DateTime::createFromFormat("M d, Y", $stopSmokingDate);
            $stopDate = $dateObj->format("Y-m-d");
        } 
        $this->stopSmokingDate = $stopDate;
    }

    public function setSmokingComments($smokingComments) {
        $this->smokingComments = $smokingComments;
    }

    public function setDrinker($drinker) {
        $this->drinker = $drinker;
    }

    public function setDrinkingSinceQuantity($drinkingSinceQuantity) {
        $this->drinkingSinceQuantity = $drinkingSinceQuantity;
    }

    public function setDrinkingSinceInterval($drinkingSinceInterval) {
        $this->drinkingSinceInterval = $drinkingSinceInterval;
    }

    public function setDrinkingFrequency($drinkingFrequency) {
        $this->drinkingFrequency = $drinkingFrequency;
    }

    public function setStopDrinkingDate($stopDrinkingDate) {
        $stopDate = '';
        if (\trim($stopDrinkingDate) != '') { 
            $dateObj = \DateTime::createFromFormat("M d, Y", stopDrinkingDate);
            $stopDate = $dateObj->format("Y-m-d");
        } 
        $this->stopDrinkingDate = $stopDate;
    }

    public function setDrinkingComments($drinkingComments) {
        $this->drinkingComments = $drinkingComments;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function getByPatientId($patientId) {
        return $this->getEntityByMultipleCriteria(["patientId"], [$patientId], TRUE);
    }
}
