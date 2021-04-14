<?php

namespace Admin\Model;

use Neptune\Logger;

/**
 * PhysicalActivity
 * @package self-health
 * @author Randal Neptune
 */
class PhysicalActivity extends Logger {
    protected $_tableName = "physical_activities";
    protected $primaryKeyField = "physical_activity_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg = "The physical activity has already been defined";

    protected $fieldMapper = array(
         "id" => ["physical_activity_id","T"],
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
