<?php

namespace Clinical\Model;

use Neptune\DbMapper;

/**
 * VisitTestThreshold
 * @package self-health
 * @author Randal Neptune
 */

class VitalTestThreshold extends DbMapper {
    protected $_tableName = "vital_test_thresholds";
    protected $primaryKeyField = "vital_test_threshold_id";

    protected $uniqueCombo = [["vitalTestId","ageRangeId","genderId","lowerLimit","upperLimit"]];
    protected $uniqueComboErrorMsg = "A similar vital test threshold has already been defined.";

    protected $fieldMapper = array(
        "id" => ["vital_test_threshold_id","T"],
        "vitalTestId" => ["vital_test_id","T"],
        "ageRangeId" => ["age_range_id","T"],
        "genderId" => ["gender_id","T"],
        "lowerLimit" => ["lower_limit","R"],
        "upperLimit" => ["upper_limit","R"]
    );
    
    protected $vitalTestId;
    protected $ageRangeId;
    protected $genderId;
    protected $lowerLimit;
    protected $upperLimit;
    
    protected $vitalTest;
    protected $ageRange;
    protected $gender;
    
    public function __construct() {
        parent::__construct();
        $this->gender = new \Admin\Model\Gender();
        $this->vitalTest = new VitalTest();
        $this->ageRange = new \Utility\Model\AgeRange();
    }
    
    public function getVitalTestId() {
        return $this->vitalTestId;
    }

    public function getAgeRangeId() {
        return $this->ageRangeId;
    }

    public function getGenderId() {
        return $this->genderId;
    }

    public function getLowerLimit() {
        return $this->lowerLimit;
    }

    public function getUpperLimit() {
        return $this->upperLimit;
    }

    public function getVitalTest() {
        return $this->vitalTest->getObjectById($this->getVitalTestId());
    }

    public function getAgeRange() {
        return $this->ageRange->getObjectById($this->getAgeRangeId());
    }

    public function getGender() {
        return $this->gender->getObjectById($this->getGenderId());
    }
    
    public function setVitalTestId($vitalTestId) {
        $this->vitalTestId = $vitalTestId;
    }

    public function setAgeRangeId($ageRangeId) {
        $this->ageRangeId = $ageRangeId;
    }

    public function setGenderId($genderId) {
        $this->genderId = $genderId;
    }

    public function setLowerLimit($lowerLimit) {
        $this->lowerLimit = $lowerLimit;
    }

    public function setUpperLimit($upperLimit) {
        $this->upperLimit = $upperLimit;
    }

    public function setVitalTest($vitalTest) {
        $this->vitalTest = $vitalTest;
    }

    public function setAgeRange($ageRange) {
        $this->ageRange = $ageRange;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getByVitalTest($vitalTestId) {
        return $this->getObjectsByMultipleCriteria(["vitalTestId"], [$vitalTestId], TRUE);
    }
    
    public function __toString() {
        return $this->getVitalTest()->getLabel() .' - '.$this->getGender()->getLabel(). ' - '.$this->getAgeRange()->getLabel();
    }

    public function getLabel() {
        return $this->getVitalTest()->getLabel() .' - '.$this->getGender()->getLabel(). ' - '.$this->getAgeRange()->getLabel();
    }
}
