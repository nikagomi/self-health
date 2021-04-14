<?php

namespace Utility\Model;

use Neptune\DbMapper;

/**
 * AgeRange
 * @package self-health
 * @author Randal Neptune
 */
class AgeRange extends DbMapper {
    protected $_tableName = "age_ranges";
    protected $primaryKeyField = "age_range_id";

    protected $uniqueCombo = [["name"],["lowerLimit","upperlImit"]];
    protected $uniqueComboErrorMsg = "The age range seems to have already been defined";

    protected $fieldMapper = array(
        "id" => ["age_range_id","T"],
        "name" => ["name","T"],
        "lowerLimit" => ["lower_limit","I"],
        "upperLimit" => ["upper_limit","I"]
    );

    protected $name;
    protected $lowerLimit;
    protected $upperLimit;
    
    public function getName() {
        return $this->name;
    }

    public function getLowerLimit() {
        return $this->lowerLimit;
    }

    public function getUpperLimit() {
        return $this->upperLimit;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLowerLimit($lowerLimit) {
        $this->lowerLimit = $lowerLimit;
    }

    public function setUpperLimit($upperLimit) {
        $this->upperLimit = $upperLimit;
    }

    public function __toString() {
        return $this->getName();
    }
    
    public function getLabel() {
        return $this->getName();
    }
    
    public function getByAge ($age) {
        $whereClause = [
            ["classProperty" => "lowerLimit", "propertyValue" => $age, "condition" => "<="],
            ["classProperty" => "upperLimit", "propertyValue" => $age, "condition" => ">="]
        ];
        $objArr = $this->retrieveObjectsByMultipleCriteria($whereClause, TRUE, TRUE,"name", 1);
        return $objArr[0];
    }
}
