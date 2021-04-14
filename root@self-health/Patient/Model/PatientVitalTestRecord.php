<?php

namespace Patient\Model;

use Neptune\{Logger, Modifiable, DbMapperUtility};

/**
 * PatientVitalTestRecord
 * @package self-health
 * @author Randal Neptune
 */
class PatientVitalTestRecord extends Logger implements Modifiable {
    protected $_tableName = "patient_vital_test_records";
    protected $primaryKeyField = "patient_vital_test_record_id";

    protected $uniqueCombo = [["patientId","recordDate","recordTime"]];
    protected $uniqueComboErrorMsg = "A vital record for the stipulated date and time already exists.";

    protected $fieldMapper = [
        "id" => ["patient_vital_test_record_id","T"],
        "patientId" => ["patient_id","T"],
        "recordDate" => ["record_date","D"],
        "recordTime" => ["record_time","D"],
        "patientPosition" => ["patient_position","T"],
        "createdTime" => ["created_time","TS"],
        "createdById" => ["created_by_id","T"],
        "modifiedTime" => ["modified_time","TS"],
        "modifiedById" => ["modified_by_id","T"]
    ];
    
    protected $patientId;
    protected $recordDate;
    protected $recordTime;
    protected $patientPosition;
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

    public function getRecordDate() {
        return $this->recordDate;
    }
    
    public function displayRecordDate() {
        return DbMapperUtility::formatSqlDate($this->getRecordDate());
    }

    public function getRecordTime() {
        return $this->recordTime;
    }
    
    public function displayRecordTime() {
        return DbMapperUtility::twelveHrAmPm($this->getRecordTime());
    }

    public function getPatientPosition() {
        return $this->patientPosition;
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
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
    
    public function getCreatedBy() {
        return $this->createdBy->getObjectById($this->getCreatedById());
    }

    public function getModifiedBy() {
        return $this->modifiedBy->getObjectById($this->getModifiedById());
    }

    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setRecordDate($recordDate) {
        $dateObj = \DateTime::createFromFormat("M d, Y", $recordDate);
        $this->recordDate = $dateObj->format("Y-m-d");
    }

    public function setRecordTime($recordTime) {
        $timeObj = \DateTime::createFromFormat("g:i A", $recordTime);
        $this->recordTime = $timeObj->format("H:i:s");
    }

    public function setPatientPosition($patientPosition) {
        $this->patientPosition = $patientPosition;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
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
    
    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function setModifiedBy($modifiedBy) {
        $this->modifiedBy = $modifiedBy;
    }
    
    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE, "id", $this->getClassName(), FALSE, "recordDate");
    }

    public function getItems() {
        return (new PatientVitalTestRecordItem())->getByPatientVitalTestRecordId($this->getId());
    }
    
    public function getAssociatedVitalTests () {
        $tests = [];
        $items = $this->getItems();
        foreach ($items as $item) {
            \array_push($tests, $item->getVitalTest());
        }
        return $tests;
    }
    
    public function calculateBMI () {
        $items = $this->getItems();
       
        $bmiHeightComponentTest = (new \Clinical\Model\VitalTest())->getBMIHeightComponentTest();
        $bmiWeightComponentTest = (new \Clinical\Model\VitalTest())->getBMIWeightComponentTest();
        $height = NULL;
        $weight = NULL;
        $bmi = '';
        foreach ($items as $item) {
            if ($item->getVitalTestId() == $bmiHeightComponentTest->getId()) {
                $height = $item->getTestResult();
            }
            if ($item->getVitalTestId() == $bmiWeightComponentTest->getId()) {
                $weight = $item->getTestResult();
            }
        }
        if (!is_null($height) && !is_null($weight)) {
            $bmi = DbMapperUtility::formatDecimalPlaces((($weight /($height * $height)) * 10000), 1);
        }
        return $bmi;
    }
    

}
