<?php

namespace Patient\Model;

use Neptune\Logger;

/**
 * NextOfKin
 * @package self-health
 * @author Randal Neptune
 */
class NextOfKin extends Logger {
    protected $_tableName = "next_of_kins";
    protected $primaryKeyField = "next_of_kin_id";

    protected $uniqueCombo = [["patientId","relationshipTypeId","name"]];
    protected $uniqueComboErrorMsg = "This next of kin relationship may have already been defined.";

    protected $fieldMapper = [
        "id" => ["next_of_kin_id","T"],
        "patientId" => ["patient_id","T"],
        "relationshipTypeId" => ["relationship_type_id","T"],
        "name" => ["name","T"],
        "contactNumber" => ["contact_number","T"]
    ];
    
    protected $patientId;
    protected $relationshipTypeId;
    protected $name;
    protected $contactNumber;
    
    protected $patient;
    protected $relationshipType;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
        $this->relationshipType = new \Admin\Model\RelationshipType();
    }
    
    public function getPatientId() {
        return $this->patientId;
    }

    public function getRelationshipTypeId() {
        return $this->relationshipTypeId;
    }

    public function getName() {
        return $this->name;
    }

    public function getContactNumber() {
        return $this->contactNumber;
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
    }

    public function getRelationshipType() {
        return $this->relationshipType->getObjectById($this->getRelationshipTypeId());
    }

    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setRelationshipTypeId($relationshipTypeId) {
        $this->relationshipTypeId = $relationshipTypeId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setContactNumber($contactNumber) {
        $this->contactNumber = $contactNumber;
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setRelationshipType($relationshipType) {
        $this->relationshipType = $relationshipType;
    }

    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE);
    }
}
