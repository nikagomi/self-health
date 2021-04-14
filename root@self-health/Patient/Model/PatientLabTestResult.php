<?php

namespace Patient\Model;

use Neptune\{Logger};

/**
 * PatientLabTestResult
 * @package self-health
 * @author Randal Neptune
 */
class PatientLabTestResult extends Logger {
    protected $_tableName = "patient_lab_test_results";
    protected $primaryKeyField = "patient_lab_test_result_id";

    protected $uniqueCombo = [["patientLabTestRecordId","labTestId"]];
    protected $uniqueComboErrorMsg = "A result for the indicated lab test has already been entered.";

    protected $fieldMapper = [
        "id" => ["patient_lab_test_result_id","T"],
        "patientLabTestRecordId" => ["patient_lab_test_record_id","T"],
        "labTestId" => ["lab_test_id","T"],
        "testResult" => ["test_result","T"]
    ];
    
    protected $patientLabTestRecordId;
    protected $labTestId;
    protected $testResult;
  
    protected $patientLabTestRecord;
    protected $labTest;
    
    
    public function __construct() {
        parent::__construct();
        $this->patientLabTestRecord = new PatientLabTestRecord();
        $this->labTest = new \Clinical\Model\LabTest();
    }
    
    public function getPatientLabTestRecordId() {
        return $this->patientLabTestRecordId;
    }

    public function getLabTestId() {
        return $this->labTestId;
    }

    public function getTestResult() {
        return $this->testResult;
    }

    public function getPatientLabTestRecord() {
        return $this->patientLabTestRecord->getObjectById($this->getPatientLabTestRecordId());
    }

    public function getLabTest() {
        return $this->labTest->getObjectById($this->getLabTestId());
    }
    
    public function setLabTestId($labTestId) {
        $this->labTestId = $labTestId;
    }

    public function setTestResult($testResult) {
        $this->testResult = $testResult;
    }

    public function setPatientLabTestRecord($patientLabTestRecord) {
        $this->patientLabTestRecord = $patientLabTestRecord;
    }

    public function setLabTest($labTest) {
        $this->labTest = $labTest;
    }
    
    public function setPatientLabTestRecordId($patientLabTestRecordId) {
        $this->patientLabTestRecordId = $patientLabTestRecordId;
    }

    public function getByLabTestRecord($patientLabTestRecordId) {
        return $this->getObjectsByMultipleCriteria(["patientLabTestRecordId"], [$patientLabTestRecordId], TRUE);
    }

    public function getLabTestsByLabTestRecord($patientLabTestRecordId) {
        $objArr = [];
        $labTestResults = $this->getByLabTestRecord($patientLabTestRecordId);
        foreach ($labTestResults as $labTestResult) {
            \array_push($objArr, $labTestResult->getLabTest());
        }
        return $objArr;
    }
    
    public function getResultByRecordAndLabTest($patientLabTestRecordId, $labTestId) {
        return $this->getEntityByMultipleCriteria(["patientLabTestRecordId","labTestId"], [$patientLabTestRecordId, $labTestId], TRUE);
    }
    
    public function recordLabTestResults($patientLabTestRecordId, array $labTestIds, array $testResults) {
        
        if(\count($labTestIds) > 0) {     
            $sql = "";
            $resultItems = $this->getObjectsByMultipleCriteria(["patientLabTestRecordId"], [$patientLabTestRecordId], TRUE);
            $propertyArr = ["patientLabTestRecordId", "labTestId"];
            foreach($resultItems as $resultItem){
                $sql .= $resultItem->generateDeleteSql();
            }
            
            for($i = 0; $i < count($labTestIds); $i++){
                $newInstance =  (new $this->className())->getEntityByMultipleCriteria($propertyArr, [$patientLabTestRecordId, $labTestIds[$i]], false);
                if(!$newInstance->isIdEmpty()){//already exists in table
                    $sql .= $newInstance->generateReactivateSql();
                    //Only tests that have values will be present in the $vitalTestIds array
                    $newInstance->setDetails($testResults[$i]);
                    $sql .= $newInstance->generateUpdateSql();
                }else{// insert a new record
                    $newInstance->setPatientLabTestRecordId($patientLabTestRecordId);
                    $newInstance->setLabTestId($labTestIds[$i]);
                    $newInstance->setTestResult($testResults[$i]);
                    $newInstance->setId('');
                    $sql .= $newInstance->generateSaveSql();
                }
            }
            $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
            return $this->dbQuery($dbTransaction);
        } else {
            return false;
        }
    }

}
