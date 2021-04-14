<?php

namespace Admin\Model;

use Neptune\Logger;

/**
 * QuantityUnit
 * @package self-health
 * @author Randal Neptune
 */
class QuantityTakenUnit extends Logger {
    protected $_tableName = "quantity_taken_units";
    protected $primaryKeyField = "quantity_taken_unit_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg = "The quantity taken unit has already been defined";

    protected $fieldMapper = array(
         "id" => ["quantity_taken_unit_id","T"],
         "name" => ["name","T"]
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
