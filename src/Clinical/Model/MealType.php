<?php

namespace Clinical\Model;

use Neptune\DbMapper;

/**
 * MealType
 * @package self-report
 * @author Randal Neptune
 */
class MealType extends DbMapper {
    protected $_tableName = "meal_types";
    protected $primaryKeyField = "meal_type_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg = "The meal type has already been defined";

    protected $fieldMapper = array(
         "id" => array("meal_type_id","T"),
         "name" => array("name","T")
    );

    protected $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getLabel() {
        return $this->getName();
    }
}
