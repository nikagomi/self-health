<?php

namespace Patient\Model;

use Neptune\{Logger};

/**
 * PatientVitalTestRecordItem
 * @package self-health
 * @author Randal Neptune
 */
class PatientVitalTestRecordItem extends Logger {
    protected $_tableName = "patient_vital_test_record_items";
    protected $primaryKeyField = "patient_vital_test_record_item_id";

    protected $uniqueCombo = [["patientVitalTestRecordId","vitalTestId"]];
    protected $uniqueComboErrorMsg = "A result may have already been entered for the vital test.";

    protected $fieldMapper = [
        "id" => ["patient_vital_test_record_item_id","T"],
        "patientVitalTestRecordId" => ["patient_vital_test_record_id","T"],
        "vitalTestId" => ["vital_test_id","T"],
        "testResult" => ["test_result","R"]
    ];
    
    protected $patientVitalTestRecordId;
    protected $vitalTestId;
    protected $testResult;
    
    protected $patientVitalTestRecord;
    protected $vitalTest;
    
    
    public function __construct() {
        parent::__construct();
        $this->patientVitalTestRecord = new PatientVitalTestRecord();
        $this->vitalTest = new \Clinical\Model\VitalTest();
    }
    
    public function getPatientVitalTestRecordId() {
        return $this->patientVitalTestRecordId;
    }

    public function getVitalTestId() {
        return $this->vitalTestId;
    }

    public function getTestResult() {
        return $this->testResult;
    }

    public function getPatientVitalTestRecord() {
        return $this->patientVitalTestRecord->getObjectById($this->getPatientVitalTestRecordId());
    }

    public function getVitalTest() {
        return $this->vitalTest->getObjectById($this->getVitalTestId());
    }

    public function setPatientVitalTestRecordId($patientVitalTestRecordId) {
        $this->patientVitalTestRecordId = $patientVitalTestRecordId;
    }

    public function setVitalTestId($vitalTestId) {
        $this->vitalTestId = $vitalTestId;
    }

    public function setTestResult($testResult) {
        $this->testResult = $testResult;
    }

    public function setPatientVitalTestRecord($patientVitalTestRecord) {
        $this->patientVitalTestRecord = $patientVitalTestRecord;
    }

    public function setVitalTest($vitalTest) {
        $this->vitalTest = $vitalTest;
    }

    public function getByPatientVitalTestRecordId ($patientVitalTestRecordId) {
        return $this->getObjectsByMultipleCriteria(["patientVitalTestRecordId"], [$patientVitalTestRecordId], TRUE);
    }
    
    public function recordVitalTestItems($patientVitalTestRecordId, array $vitalTestIds, array $testResults) {
        $sql = "";
        $recordedItems = $this->getObjectsByMultipleCriteria(["patientVitalTestRecordId"], [$patientVitalTestRecordId], TRUE);
        if(\count($vitalTestIds) > 0){     
            //$now = \date("Y-m-d H:i:s");
            $propertyArr = ["patientVitalTestRecordId", "vitalTestId"];
            foreach($recordedItems as $recordedItem){
                $sql .= $recordedItem->generateDeleteSql();
            }
            for($i = 0; $i < count($vitalTestIds); $i++){
                $newInstance =  (new $this->className())->getEntityByMultipleCriteria($propertyArr, [$patientVitalTestRecordId, $vitalTestIds[$i]], false);
                if(!$newInstance->isIdEmpty()){//already exists in table
                    $sql .= $newInstance->generateReactivateSql();
                    //Only tests that have values will be present in the $vitalTestIds array
                    $newInstance->setTestResult($testResults[$i]);
                    $sql .= $newInstance->generateUpdateSql();
                }else{// insert a new record
                    $newInstance->setPatientVitalTestRecordId($patientVitalTestRecordId);
                    $newInstance->setVitalTestId($vitalTestIds[$i]);
                    $newInstance->setTestResult($testResults[$i]);
                    $newInstance->setId('');
                    $sql .= $newInstance->generateSaveSql();
                }
            }
            $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
            $result =  $this->dbQuery($dbTransaction);
            return ($result != false);
        }
        return false;
    }

    public function getByRecordAndVitalTestId($patientVitalTestRecordId, $vitalTestId) {
        return $this->getEntityByMultipleCriteria(["vitalTestId","patientVitalTestRecordId"], [$vitalTestId,$patientVitalTestRecordId], TRUE);
    }
    
    
}
