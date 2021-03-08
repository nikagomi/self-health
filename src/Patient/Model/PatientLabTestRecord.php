<?php

namespace Patient\Model;

use Neptune\{Logger, Modifiable, DbMapperUtility};

/**
 * PatientLabTestRecord
 * @package self-health
 * @author Randal Neptune
 */
class PatientLabTestRecord extends Logger implements Modifiable {
    protected $_tableName = "patient_lab_test_records";
    protected $primaryKeyField = "patient_lab_test_record_id";

    protected $uniqueCombo = [["patientId","testDate"]];
    protected $uniqueComboErrorMsg = "There already exist lab test records for this date.";

    protected $fieldMapper = [
        "id" => ["patient_lab_test_record_id","T"],
        "patientId" => ["patient_id","T"],
        "testDate" => ["test_date","D"],
        "notes" => ["notes","T"],
        "createdTime" => ["created_time","TS"],
        "createdById" => ["created_by_id","T"],
        "modifiedTime" => ["modified_time","TS"],
        "modifiedById" => ["modified_by_id","T"]
    ];
    
    protected $patientId;
    protected $testDate;
    protected $notes;
    protected $createdTime;
    protected $createdById;
    protected $modifiedTime;
    protected $modifiedById;
    
    protected $patient;
    protected $createdBy;
    protected $modifiedBy;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
        $this->createdBy = new \Authentication\Model\User();
        $this->modifiedBy = new \Authentication\Model\User();
    }
    
    public function getPatientId() {
        return $this->patientId;
    }

    public function getTestDate() {
        return $this->testDate;
    }
    
    public function displayTestDate() {
        return DbMapperUtility::formatSqlDate($this->getTestDate());
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

    public function getCreatedBy() {
        return $this->createdBy->getObjectById($this->getCreatedById());
    }

    public function getModifiedBy() {
        return $this->modifiedBy->getObjectById($this->getModifiedById());
    }

    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setTestDate($testDate) {
        $dateObj = \DateTime::createFromFormat("M d, Y", $testDate);
        $this->testDate = $dateObj->format("Y-m-d");
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

    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function setModifiedBy($modifiedBy) {
        $this->modifiedBy = $modifiedBy;
    }

    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE, "id", $this->getClassName(), FALSE, "testDate");
    }
    
    public function getLabTestResults() {
        return (new PatientLabTestResult())->getByLabTestRecord($this->getId());
    }
    
    public function getLabTests() {
        return (new PatientLabTestResult())->getLabTestsByLabTestRecord($this->getId());
    }
    
    public function getResultListingArray() {
        $results = $this->getLabTestResults();
        $listing = [];
        foreach ($results as $result) {
            \array_push($listing, $result->getLabTest()->getLabel().": <b>".$result->getTestResult().' '.$result->getLabTest()->getUnit()."</b>");
        }
        return $listing;
    }
}
