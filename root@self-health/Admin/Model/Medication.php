<?php

namespace Admin\Model;

use Neptune\Logger;

/**
 * Medication
 * @package self-health
 * @author Randal Neptune
 */
class Medication extends Logger {
    protected $_tableName = "medications";
    protected $primaryKeyField = "medication_id";

    protected $uniqueCombo = [["pharmaceuticalId", "dosage"]];
    protected $uniqueComboErrorMsg = "The medication (pharmaceutical - dosage combination) has already been defined";

    protected $fieldMapper = array(
        "id" => ["medication_id","T"],
        "pharmaceuticalId" => ["pharmaceutical_id","T"],
        "dosage" => ["dosage","T"]
    );

    protected $pharmaceuticalId;
    protected $dosage;
    
    protected $pharmaceutical;

    public function __construct() {
        parent::__construct();
        $this->pharmaceutical = new Pharmaceutical();
    }
    
    public function getPharmaceuticalId() {
        return $this->pharmaceuticalId;
    }

    public function getDosage() {
        return $this->dosage;
    }

    public function getPharmaceutical() {
        return $this->pharmaceutical->getObjectById($this->getPharmaceuticalId());
    }

    public function setPharmaceuticalId($pharmaceuticalId) {
        $this->pharmaceuticalId = $pharmaceuticalId;
    }

    public function setDosage($dosage) {
        $this->dosage = $dosage;
    }

    public function setPharmaceutical($pharmaceutical) {
        $this->pharmaceutical = $pharmaceutical;
    }

    public function getLabel() {
        return $this->getPharmaceutical()->getLabel() . " ". $this->getDosage();
    }
    
    public function getByPharmaceuticalId ($pharmaceuticalId) {
        return $this->getObjectsByMultipleCriteria(["pharmaceuticalId"], [$pharmaceuticalId], true);
    }
}
