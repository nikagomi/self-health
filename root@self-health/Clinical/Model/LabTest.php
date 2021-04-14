<?php

namespace Clinical\Model;

use Neptune\DbMapper;

/**
 * Description of LabTest
 * @package self-health
 * @author Randal Neptune
 */
class LabTest extends DbMapper {
    protected $_tableName = "lab_tests";
    protected $primaryKeyField = "lab_test_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg = "The lab test has already been defined";

    protected $fieldMapper = array(
        "id" => ["lab_test_id","T"],
        "name" => ["name","T"],
        "unit" => ["unit","T"],
        "numeric" => ["is_numeric","B"]
    );

    protected $name;
    protected $numeric;
    protected $unit;

    public function getName() {
        return $this->name;
    }
    
    public function getNumeric() {
        return $this->numeric;
    }
    
    public function isNumeric() {
        return ($this->getNumeric() == 't' || $this->getNumeric() == 1) ? (bool) true : (bool) false;
    }
    
    public function getUnit() {
        return $this->unit;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
    }

    public function setNumeric($numeric) {
        $this->numeric = $numeric;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getLabel() {
        return $this->getName();
    }
    
    public function __toString() {
        return $this->getLabel();
    }
}
