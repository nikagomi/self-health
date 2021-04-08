<?php

namespace Admin\Model;

use Neptune\Logger;

/**
 * Pharmaceutical
 * @package self-health
 * @author Randal Neptune
 */
class Pharmaceutical extends Logger {
    protected $_tableName = "pharmaceuticals";
    protected $primaryKeyField = "pharmaceutical_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg = "The pharmaceutical has already been defined";

    protected $fieldMapper = array(
         "id" => ["pharmaceutical_id","T"],
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
