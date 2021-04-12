<?php

namespace Patient\Model;

use Neptune\{Logger};


/**
 * PatientAllergyRecord
 * @package self-health
 * @author Randal Neptune
 */
class PatientAllergyRecord extends Logger {
    protected $_tableName = "patient_allergies";
    protected $primaryKeyField = "patient_allergy_id";

    protected $uniqueCombo = [["patientId","allergyTypeId","allergen"]];
    protected $uniqueComboErrorMsg = "An allergy for the selected allergen has already been defined.";

    protected $fieldMapper = array(
        "id" => ["patient_allergy_id","T"],
        "patientId" => ["patient_id","T"],
        "allergyTypeId" => ["allergy_type_id","T"],
        "allergen" => ["allergen","T"],
        "notes" => ["notes","T"]
    );
    
    protected $patientId;
    protected $allergyTypeId;
    protected $allergen;
    protected $notes;
    
    protected $patient;
    protected $allergyType;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
        $this->allergyType = new \Admin\Model\AllergyType();
    }
    
    public function getPatientId() {
        return $this->patientId;
    }

    public function getAllergyTypeId() {
        return $this->allergyTypeId;
    }

    public function getAllergen() {
        return $this->allergen;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
    }

    public function getAllergyType() {
        return $this->allergyType->getObjectById($this->getAllergyTypeId());
    }


    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setAllergyTypeId($allergyTypeId) {
        $this->allergyTypeId = $allergyTypeId;
    }

    public function setAllergen($allergen) {
        $this->allergen = $allergen;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setAllergyType($allergyType) {
        $this->allergyType = $allergyType;
    }

    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE);
    }
}
