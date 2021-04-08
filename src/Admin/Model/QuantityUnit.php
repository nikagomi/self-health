<?php

namespace Admin\Model;

use Neptune\Logger;

/**
 * QuantityUnit
 * @package self-health
 * @author Randal Neptune
 */
class QuantityUnit extends Logger {
    protected $_tableName = "quantity_units";
    protected $primaryKeyField = "quantity_unit_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg = "The quantity unit has already been defined";

    protected $fieldMapper = array(
         "id" => ["quantity_unit_id","T"],
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
