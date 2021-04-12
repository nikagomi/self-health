<?php

namespace Admin\Model;

use Neptune\DbMapper;

/**
 * ChronicDisease
 * @package self-health
 * @author Randal Neptune
 */
class ChronicDisease extends DbMapper {
    protected $_tableName = "chronic_diseases";
    protected $primaryKeyField = "chronic_disease_id";

    protected $uniqueCombo = array(array("name"));
    protected $uniqueComboErrorMsg = "The chronic disease type is already defined";

    protected $fieldMapper = array(
         "id" => array("chronic_disease_id","T"),
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
