<?php

namespace Clinical\Model;

use Neptune\Logger;
/**
 * VitalTest
 * @package self-health
 * @author Randal Neptune
 */
class VitalTest extends Logger {
    protected $_tableName = "vital_tests";
    protected $primaryKeyField = "vital_test_id";

    protected $uniqueCombo = [["name"],["abbreviation"], ["__maxCount:1","bpTest:true", "bpTestOrder"], ["__maxCount:1","bmiWeightComponent", "bmiHeightComponent:true"], ["__maxCount:1","bmiHeightComponent", "bmiWeightComponent:true"]];
    protected $uniqueComboErrorMsg = "Some portions of the defined test may conflict with previously defined tests";

    protected $fieldMapper = array(
        "id" => ["vital_test_id","T"],
        "name" => ["test_name","T"],
        "abbreviation" => ["abbreviation","T"],
        "unit" => ["unit","T"],
        "numeric" => ["numeric_test","B"],
        "bpTest" => ["bp_test","B"],
        "bpTestOrder" => ["bp_test_order","I"],
        "sortOrder" => ["sort_order", "I"],
        "bmiHeightComponent" => ["bmi_height_component","B"],
        "bmiWeightComponent" => ["bmi_weight_component","B"]
    );
    
    protected $name;
    protected $abbreviation;
    protected $unit;
    protected $numeric;
    protected $bpTest;
    protected $bpTestOrder;
    protected $sortOrder;
    protected $bmiHeightComponent;
    protected $bmiWeightComponent;
    
    public function getName() {
        return $this->name;
    }

    public function getAbbreviation() {
        return $this->abbreviation;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function getNumeric() {
        return $this->numeric;
    }
    
    public function isNumeric() {
        return ($this->numeric == 't' || $this->numeric == 1) ? (bool) true : (bool) false;
    }
    
    public function getBpTest() {
        return $this->bpTest;
    }
    
    public function isBpTest() {
        return ($this->bpTest == 1 || $this->bpTest == 't') ? (bool) true : (bool) false;
    }
    
    public function getBpTestOrder() {
        return $this->bpTestOrder;
    }
    
    public function getSortOrder() {
        return $this->sortOrder;
    }
    
    public function getBmiHeightComponent() {
        return $this->bmiHeightComponent;
    }
    
    public function isBmiHeightComponent() {
        return ($this->bmiHeightComponent == 1 || $this->bmiHeightComponent =='t') ? (bool) true : (bool) false;
    }

    public function getBmiWeightComponent() {
        return $this->bmiWeightComponent;
    }
    
    public function isBmiWeightComponent() {
        return ($this->bmiWeightComponent == 1 || $this->bmiWeightComponent =='t') ? (bool) true : (bool) false;
    }

    public function setBmiHeightComponent($bmiHeightComponent) {
        $this->bmiHeightComponent = $bmiHeightComponent;
    }

    public function setBmiWeightComponent($bmiWeightComponent) {
        $this->bmiWeightComponent = $bmiWeightComponent;
    }

    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;
    }

    public function setBpTestOrder($bpTestOrder) {
        $this->bpTestOrder = $bpTestOrder;
    }

    public function setBpTest($bpTest) {
        $this->bpTest = $bpTest;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAbbreviation($abbreviation) {
        $this->abbreviation = $abbreviation;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
    }

    public function setNumeric($numeric) {
        $this->numeric = $numeric;
    }

    public function __toString() {
        return $this->getName();
    }
    
    public function getLabel() {
        return $this->getName();
    }
    
    public function getNumericVitalTests () {
        return $this->getObjectsByMultipleCriteria(["numeric"], TRUE, TRUE, "id", $this->getClassName(), TRUE, "name");
    }
    
    public function getBPTests() {
        return $this->getObjectsByMultipleCriteria(["bpTest"], [TRUE], TRUE, "id", $this->getClassName(), TRUE, "bpTestOrder");
    }
    
    public function getNonBPTests() {
        return $this->getObjectsByMultipleCriteria(["bpTest"], [FALSE], TRUE, "id", $this->getClassName(), TRUE, "sortOrder");
    }
    
    public function getBMIHeightComponentTest () {
        return $this->getEntityByMultipleCriteria(["bmiHeightComponent"], [TRUE], TRUE);
    }
    
    public function getBMIWeightComponentTest () {
        return $this->getEntityByMultipleCriteria(["bmiWeightComponent"], [TRUE], TRUE);
    }
    
    
}
