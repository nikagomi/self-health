<?php

namespace Authentication\Model;

use Neptune\Logger;
/**
 * Group
 * @package hiags
 * @author Randal Neptune
 */
class Group extends Logger{
    protected $_tableName = "groups";
    protected $primaryKeyField = "group_id";

    protected $uniqueCombo = array(array("name"));
    protected $uniqueComboErrorMsg;

    protected $fieldMapper = array(
        "id" => array("group_id","T"),
        "name" => array("name","T"),
        "description" => array("description","T")
    );
   
    protected $name;
    protected $description;
    
    protected $labelSortProperty = "name";

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setName($name) {
        $this->name = $name;
    }
   
    public function getLabel() {
        return $this->getName();
    }
    
}
