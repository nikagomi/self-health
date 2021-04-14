<?php

namespace Patient\Model;

use Neptune\Logger;

/**
 * PatientChronicDisease
 * @package self-health
 * @author Randal Neptune
 */
class PatientChronicDisease extends Logger {
    protected $_tableName = "patient_chronic_diseases";
    protected $primaryKeyField = "patient_chronic_disease_id";

    protected $uniqueCombo = [["patientId","chronicDiseaseId"]];
    protected $uniqueComboErrorMsg = "The chronic disease is already associated to this patient.";

    protected $fieldMapper = array(
        "id" => ["patient_chronic_disease_id","T"],
        "patientId" => ["patient_id","T"],
        "chronicDiseaseId" => ["chronic_disease_id","T"],
        "diagnosedSinceYear" => ["diagnosed_since_year","I"]
    );
    
    protected $patientId;
    protected $chronicDiseaseId;
    protected $diagnosedSinceYear;
    
    protected $patient;
    protected $chronicDisease;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
        $this->chronicDisease = new \Admin\Model\ChronicDisease();
    }
    
    public function getPatientId() {
        return $this->patientId;
    }

    public function getChronicDiseaseId() {
        return $this->chronicDiseaseId;
    }

    public function getDiagnosedSinceYear() {
        return $this->diagnosedSinceYear;
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
    }

    public function getChronicDisease() {
        return $this->chronicDisease->getObjectById($this->getChronicDiseaseId());
    }
    
    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setChronicDiseaseId($chronicDiseaseId) {
        $this->chronicDiseaseId = $chronicDiseaseId;
    }

    public function setDiagnosedSinceYear($diagnosedSinceYear) {
        $this->diagnosedSinceYear = $diagnosedSinceYear;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setChronicDisease($chronicDisease) {
        $this->chronicDisease = $chronicDisease;
    }

    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE);
    }
    
    public function recordChronicDiseases($patientId, array $chronicDiseaseIds, array $years) {
        $sql = "";
        if(\count($chronicDiseaseIds) > 0){
            $patientDiseases = $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE);
        
            $propertyArr = ["patientId", "chronicDiseaseId"];
            foreach($patientDiseases as $pd){
                $sql .= $pd->generateDeleteSql();
            }

            for($i = 0; $i < \count($chronicDiseaseIds); $i++){
                $newInstance =  (new $this->className())->getEntityByMultipleCriteria($propertyArr, [$patientId, $chronicDiseaseIds[$i]], false);
                if($newInstance->getId() != ''){//already exists in table
                    $sql .= $newInstance->generateReactivateSql();
                    if ($newInstance->getDiagnosedSinceYear() != $years[$i]) {
                        $newInstance->setDiagnosedSinceYear($years[$i]);
                        $sql .= $newInstance->generateUpdateWithEmptyFieldsSql();
                    }
                }else{// insert a new record
                    $newInstance->setPatientId($patientId);
                    $newInstance->setChronicDiseaseId($chronicDiseaseIds[$i]);
                    $newInstance->setDiagnosedSinceYear($years[$i]);
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
    
    public function getByPatientAndDisease ($patientId, $chronicDiseaseId) {
        return $this->getEntityByMultipleCriteria(["patientId","chronicDiseaseId"], [$patientId, $chronicDiseaseId], TRUE);
    }
    
    public function getAssociatedChronicDiseases() {
        $objArr = [];
        $pcds = $this->getByPatientId($_SESSION['patientId']);
        foreach ($pcds as $pcd) {
            \array_push($objArr, $pcd->getChronicDisease());
        }
        return $objArr;
    }
    
}
