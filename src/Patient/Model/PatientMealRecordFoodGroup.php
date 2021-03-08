<?php

namespace Patient\Model;

use Neptune\{Logger};

/**
 * PatientMealRecordFoodGroup
 * @package  self-health
 * @author Randal Neptune
 */
class PatientMealRecordFoodGroup extends Logger {
     protected $_tableName = "patient_meal_record_food_groups";
    protected $primaryKeyField = "patient_meal_record_food_group_id";

    protected $uniqueCombo = [["patientMealRecordId","foodGroupId"]];
    protected $uniqueComboErrorMsg = "Information for this food group has already been entered for the identified meal record.";

    protected $fieldMapper = [
        "id" => ["patient_meal_record_food_group_id","T"],
        "patientMealRecordId" => ["patient_meal_record_id","T"],
        "foodGroupId" => ["food_group_id","T"],
        "details" => ["details","T"]
    ];
    
    protected $patientMealRecordId;
    protected $foodGroupId;
    protected $details;
    
    protected $patientMealRecord;
    protected $foodGroup;
    
    public function __construct() {
        parent::__construct();
        $this->patientMealRecord = new PatientMealRecord();
        $this->foodGroup = new \Clinical\Model\FoodGroup();
    }
    
    public function getFoodGroupId() {
        return $this->foodGroupId;
    }
    
    public function getPatientMealRecordId() {
        return $this->patientMealRecordId;
    }

    public function getDetails() {
        return $this->details;
    }

    public function getPatientMealRecord() {
        return $this->patientMealRecord->getObejctById($this->getPatientMealRecordId());
    }

    public function getFoodGroup() {
        return $this->foodGroup->getObjectById($this->getFoodGroupId());
    }

    public function setPatientMealRecordId($patientMealRecordId) {
        $this->patientMealRecordId = $patientMealRecordId;
    }

    public function setFoodGroupId($foodGroupId) {
        $this->foodGroupId = $foodGroupId;
    }

    public function setDetails($details) {
        $this->details = $details;
    }

    public function setPatientMealRecord($patientMealRecord) {
        $this->patientMealRecord = $patientMealRecord;
    }

    public function setFoodGroup($foodGroup) {
        $this->foodGroup = $foodGroup;
    }

    public function getByPatientMealRecordId ($patientMealRecordId) {
        return $this->getObjectsByMultipleCriteria(["patientMealRecordId"], [$patientMealRecordId], TRUE);
    }
    
    public function recordMealFoodGroups($patientMealRecordId, array $foodGroupIds, array $details) {
        $sql = "";
        $recordedItems = $this->getObjectsByMultipleCriteria(["patientMealRecordId"], [$patientMealRecordId], TRUE);
        $propertyArr = ["patientMealRecordId", "foodGroupId"];
        foreach($recordedItems as $recordedItem){
            $sql .= $recordedItem->generateDeleteSql();
        }
        
        if(\count($foodGroupIds) > 0){     
            //$now = \date("Y-m-d H:i:s");
            
            for($i = 0; $i < count($foodGroupIds); $i++){
                $newInstance =  (new $this->className())->getEntityByMultipleCriteria($propertyArr, [$patientMealRecordId, $foodGroupIds[$i]], false);
                if(!$newInstance->isIdEmpty()){//already exists in table
                    $sql .= $newInstance->generateReactivateSql();
                    //Only tests that have values will be present in the $vitalTestIds array
                    $newInstance->setDetails($details[$i]);
                    $sql .= $newInstance->generateUpdateSql();
                }else{// insert a new record
                    $newInstance->setPatientMealRecordId($patientMealRecordId);
                    $newInstance->setFoodGroupId($foodGroupIds[$i]);
                    $newInstance->setDetails($details[$i]);
                    $newInstance->setId('');
                    $sql .= $newInstance->generateSaveSql();
                }
            }
        }
        if ($sql != '') {
            $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
            
            return $this->dbQuery($dbTransaction);
        } else {
            return true;
        }
    }

    public function getByMealRecordAndFoodGroupId($patientMealRecordId, $foodGroupId) {
        return $this->getEntityByMultipleCriteria(["foodGroupId","patientMealRecordId"], [$foodGroupId, $patientMealRecordId], TRUE);
    }
    
}
