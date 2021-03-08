<?php

namespace Admin\Model;
use Neptune\Logger;

/**
 * Ethnicity
 * @package smile
 * @author Randal Neptune
 */
class Ethnicity extends Logger{
    protected $_tableName = "ethnicities";
    protected $primaryKeyField = "ethnicity_id";

    protected $uniqueCombo = array(array("name"));
    protected $uniqueComboErrorMsg;

    protected $fieldMapper = array(
         "id" => array("ethnicity_id","T"),
         "name" => array("name","T")
    );

    protected $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = \ucwords($name);
    }
    
    public function getLabel(){
        return $this->getName();
    }
}